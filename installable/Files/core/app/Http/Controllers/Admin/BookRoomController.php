<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Guest;
use App\Models\Coupon;
use App\Models\Booking;
use App\Models\RoomType;
use App\Constants\Status;
use App\Lib\CouponManager;
use App\Models\BookedRoom;
use Illuminate\Http\Request;
use App\Models\AppliedCoupon;
use App\Traits\BookingActions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use stdClass;

class BookRoomController extends Controller {
    use BookingActions;

    public function room() {
        session()->forget('booking_info');
        session()->forget('apply_coupon');

        $pageTitle = 'Book Room';
        $roomTypes = RoomType::active()->get(['id', 'name']);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view('admin.booking.book', compact('pageTitle', 'roomTypes', 'countries'));
    }

    function searchRoom(Request $request) {
        $validator = Validator::make($request->all(), [
            'room_type' => 'required|exists:room_types,id',
            'date' => 'required|string',
            'rooms' => 'required|integer|gt:0',
            'is_reset' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $date = explode('-', $request->date);

        $request->merge([
            'checkin_date'  => trim(@$date[0]),
            'checkout_date' => trim(@$date[1]),
        ]);

        $validator = Validator::make($request->all(), [
            'checkin_date'  => 'required|date_format:m/d/Y|after:yesterday',
            'checkout_date' => 'required|date_format:m/d/Y|after:checkin_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $bookingInfo = session()->get('booking_info') ?? collect([]);
        $firstInfo = $bookingInfo->first();
        if ($firstInfo && ($firstInfo['check_in'] != $request->checkin_date || $firstInfo['check_out'] != $request->checkout_date)) {
            return response()->json([
                'status' => false,
                'error' => 'Check-In and checkout date should be same'
            ]);
        }

        if ($request->is_reset == 0 && $bookingInfo->firstWhere('room_type', $request->room_type) != null) {
            return response()->json([
                'status' => false,
                'error' => 'Room Type already exist in the list'
            ]);
        }

        $response = json_decode($this->getRooms($request));
        if (!$response->status) {
            return response()->json([
                'status' => false,
                'error' => $response->error
            ]);
        }

        $data = [
            'check_in' => $request->checkin_date,
            'check_out' => $request->checkout_date,
            'room_type' => $request->room_type,
            'number_of_rooms' => $request->rooms
        ];

        $bookingInfo->put($request->room_type, $data);
        session()->put('booking_info', $bookingInfo);
        session()->forget('apply_coupon');

        return response()->json([
            'status' => true,
            'html' => $response->html,
            'check_in' => $request->checkin_date,
            'check_out' => $request->checkout_date,
        ]);
    }


    public function book(Request $request) {
        $validator = Validator::make($request->all(), [
            'guest_type'      => 'required|in:1,0',
            'guest_name'      => 'nullable|required_if:guest_type,0',
            'email'           => 'required|email',
            'mobile'          => 'nullable|required_if:guest_type,0|regex:/^([0-9]*)$/',
            'address'         => 'nullable|required_if:guest_type,0|string',
            'room'            => 'required|array',
            'paid_amount'     => 'nullable|numeric|gte:0',
            'total_adult'     => 'required|integer|gt:0',
            'total_child'     => 'nullable|integer|gte:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $guestId = 0;

        if ($request->guest_type == 1) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['error' => 'No registered guest found with this email']);
            }

            $contactInfo = [
                'name' => $user->fullname,
                'mobile' => $user->mobile,
                'email' => $user->email,
                'address' => $user->address,
            ];
        } else {
            $guestId = $this->insertGuestInfo($request);
            $guest = Guest::find($guestId);
            $contactInfo = [
                'name' => $guest->name,
                'mobile' => $guest->mobile,
                'email' => $guest->email,
                'address' => $guest->address,
            ];
        }

        $bookedRoomData = [];
        $totalFare      = 0;
        $totalTax       = 0;
        $totalAdultCapacity = 0;
        $totalChildCapacity = 0;

        $coupon = null;
        $discountAmount = 0;

        foreach ($request->room as $room) {
            $data      = [];
            $roomId    = $room['id'];
            $bookedFor = $room['date'];
            $isBooked  = BookedRoom::where('room_id', $roomId)->where('booked_for', $bookedFor)->exists();

            if ($isBooked) {
                return response()->json(['error' => 'Room has been booked']);
            }

            $room = Room::with('roomType')->find($roomId);

            $discountedFare = $room->roomType->roomFare();
            $singleRoomTax = $discountedFare * gs('tax') / 100;

            $totalAdultCapacity += $room->roomType->total_adult;
            $totalChildCapacity += $room->roomType->total_child;

            $data['booking_id']       = 0;
            $data['room_type_id']     = $room->room_type_id;
            $data['room_id']          = $room->id;
            $data['booked_for']       = Carbon::parse($bookedFor)->format('Y-m-d');
            $data['fare']             = $room->roomType->roomFare();
            $data['tax_charge']       = $singleRoomTax;
            $data['cancellation_fee'] = $room->roomType->cancellation_fee;
            $data['status']           = Status::ROOM_ACTIVE;
            $data['created_at']       = now();
            $data['updated_at']       = now();
            $bookedRoomData[]         = $data;

            $totalFare += $room->roomType->roomFare();
        }

        $applyCoupon = session('apply_coupon');
        if ($applyCoupon) {
            $couponManager = new CouponManager();
            $coupon = $couponManager->getCouponByCode(@$applyCoupon['coupon_code']);

            if ($coupon) {
                try {
                    $roomTypeIds = array_unique(array_column($request->room, 'type_id'));
                    $carts = $this->makeCartCollectionByProductIds($roomTypeIds);

                    $validaityResponse = $couponManager->isValidCoupon($coupon, $totalFare, $carts);
                    if(isset($validaityResponse['error'])){
                        return response()->json(['error' => $validaityResponse['error']]);
                    }

                    $discountAmount = $applyCoupon['discount_amount'];
                    if ($totalFare > $discountAmount) {
                        $totalFare -= $discountAmount;
                    }else{
                        $totalFare = 0;
                    }
                } catch (\Exception $e) {}
            }
        }

        $totalTax =  $totalFare * gs('tax') / 100;
        $totalAmount =  $totalFare + $totalTax;

        if ($request->paid_amount && $request->paid_amount > $totalAmount) {
            return response()->json(['error' => 'Paying amount can\'t be greater than total amount']);
        }

        $checkIn = Carbon::parse($request->checkin_date);
        $checkOut = $request->checkout_date ? Carbon::parse($request->checkout_date) : $checkIn;

        $totalDay = $checkIn->diffInDays($checkOut);

        $totalAdultCapacity /= $totalDay;
        $totalChildCapacity /= $totalDay;


        if ($request->total_adult > $totalAdultCapacity || $request->total_child > $totalChildCapacity) {
            return response()->json(['error' => 'The total number of adults and children exceeds the capacity limit']);
        }

        $booking                 = new Booking();
        $booking->booking_number = getTrx();
        $booking->user_id        = @$user->id ?? 0;
        $booking->guest_id       = $guestId;
        $booking->booking_info   = $contactInfo;
        $booking->total_adult    = $request->total_adult;
        $booking->total_child    = $request->total_child;
        $booking->coupon_id      = @$coupon->id;
        $booking->coupon_amount  = $discountAmount;
        $booking->tax_charge     = $totalTax;
        $booking->booking_fare   = $totalFare;
        $booking->paid_amount    = $request->paid_amount ?? 0;
        $booking->status         = Status::BOOKING_ACTIVE;
        $booking->save();

        session()->forget('booking_info');

        if($booking->coupon_id){
            $appliedCoupon            = new AppliedCoupon();
            $appliedCoupon->user_id   = @$user->id ?? 0;
            $appliedCoupon->coupon_id = $booking->coupon_id;
            $appliedCoupon->booking_id  = $booking->id;
            $appliedCoupon->amount    = $booking->coupon_amount;
            $appliedCoupon->save();
        }


        if ($request->paid_amount > 0) {
            $booking->createPaymentLog($booking->paid_amount, 'BOOKING_PAYMENT_RECEIVED');
        }
        $booking->createActionHistory('book_room');

        foreach ($bookedRoomData as $key => $bookedRoom) {
            $bookedRoomData[$key]['booking_id'] = $booking->id;
        }

        BookedRoom::insert($bookedRoomData);

        $checkIn  = BookedRoom::where('booking_id', $booking->id)->min('booked_for');
        $checkout = BookedRoom::where('booking_id', $booking->id)->max('booked_for');

        $booking->check_in = $checkIn;
        $booking->check_out = Carbon::parse($checkout)->addDay()->toDateString();
        $booking->save();

        return response()->json(['success' => 'Room booked successfully']);
    }

    private function insertGuestInfo($request) {
        $guest = new Guest();
        $guest->name = $request->guest_name;
        $guest->email = $request->email;
        $guest->mobile = $request->mobile;
        $guest->address = $request->address;
        $guest->save();

        return $guest->id;
    }

    public function getRooms(Request $request) {
        $checkIn = Carbon::parse($request->checkin_date);
        $checkOut = $request->checkout_date ? Carbon::parse($request->checkout_date) : $checkIn;


        $roomType = RoomType::active()->withCount(['rooms as total_rooms' => function ($q) {
            $q->active();
        }])
            ->addSelect(['booked_rooms' => function ($subQuery) use ($request, $checkIn, $checkOut) {
                $subQuery->selectRaw('COUNT(DISTINCT room_id)')
                    ->from('booked_rooms')
                    ->join('rooms', 'booked_rooms.room_id', 'rooms.id')
                    ->where('rooms.status', Status::ENABLE)
                    ->where('booked_rooms.status', Status::ROOM_ACTIVE)
                    ->whereBetween('booked_for', [$checkIn, $checkOut])
                    ->whereColumn('booked_rooms.room_type_id', 'room_types.id');
            }])
            ->selectRaw('(SELECT total_rooms - booked_rooms) as available_rooms')->find($request->room_type);

        if (!$roomType) {
            return json_encode([
                "status" => false,
                'error' => 'Room Type not found'
            ]);
        }

        if ($request->get_available) {
            return response()->json([
                'status' => true,
                'available_rooms' => $roomType->available_rooms
            ]);
        }

        $rooms = Room::active()
            ->where('room_type_id', $roomType->id)
            ->with([
                'booked' => function ($q) {
                    $q->active();
                },
                'roomType:id,name,fare,offer_fare,offer_id',
                'roomType:activeOffer'
            ])
            ->get();

        if ($roomType->available_rooms < $request->rooms) {
            return json_encode([
                "status" => false,
                'error' => 'The requested number of rooms is not available for the selected date'
            ]);
        }

        $numberOfRooms = $request->rooms;

        return json_encode([
            "status" => true,
            'html' => view('partials.rooms', compact('checkIn', 'checkOut', 'rooms', 'numberOfRooms', 'roomType'))->render()
        ]);
    }

    public function applyCoupon(Request $request) {
        $validator = Validator::make($request->all(), [
            'coupon_code'  => 'required',
            'amount'       => 'required|numeric|gte:0',
            'email'        => 'nullable|string|email',
            'room_type_id' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = null;

        if ($request->email) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => ['error' => 'Invalid user']
                ]);
            }
        }

        $couponManager = new CouponManager();
        $coupon = $couponManager->getCouponByCode($request->coupon_code, $user);

        if (!$coupon) {
            return response()->json([
                'status'  => 'error',
                'message' => ['error' => 'Applied coupon is invalid or expired.'],
            ]);
        }

        if ($coupon->usage_limit_per_user > 0 && !$user) {
            return response()->json([
                'status'  => 'error',
                'message' => ['error' => 'This coupon is only for the registered users.'],
            ]);
        }

        $allCartsData = $this->makeCartCollectionByProductIds($request->room_type_id);
        $checkCoupon = $couponManager->isValidCoupon($coupon, $request->amount, $allCartsData);

        if (isset($checkCoupon['error'])) {
            return response()->json([
                'status'  => 'error',
                'message' => $checkCoupon,
            ]);
        }

        $amount = $request->amount;
        $discountAmount = $coupon->discountAmount($amount);
        $totalAmountAfterDiscount = ((float)$amount - $discountAmount);
        $totalTax = ($totalAmountAfterDiscount * gs('tax') / 100);
        $totalAmountWithTax = $totalAmountAfterDiscount + $totalTax;

        session()->put('apply_coupon', [
            'coupon_code' => $request->coupon_code,
            'cart_amount' => $amount,
            'discount_amount' => $discountAmount,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => ['success' => 'Coupon apply successfully'],
            'coupon_code' => $request->coupon_code,
            'discount_amount' => showAmount($discountAmount),
            'total_tax' => showAmount($totalTax),
            'total_amount_with_tax' => showAmount($totalAmountWithTax),
            'total_amount_with_tax_value' => getAmount($totalAmountWithTax),
        ]);
    }

    public function removeCoupon(Request $request) {
        $validator = Validator::make($request->all(), [
            'amount'     => 'nullable|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if (session('apply_coupon')) {
            session()->forget('apply_coupon');
        }

        $amount = $request->amount;
        $totalTax = ($amount * gs('tax') / 100);
        $totalAmountWithTax = $amount + $totalTax;

        return response()->json([
            'status'  => 'success',
            'message' => ['success' => 'Coupon removed successfully'],
            'total_tax' => showAmount($totalTax),
            'total_amount_with_tax' => showAmount($totalAmountWithTax),
            'coupon_amount' => showAmount(0)
        ]);
    }

    private function makeCartCollectionByProductIds(array $productIds){
        $allCartsData = collect([]);
        foreach($productIds as $id){
            $cartsData = new stdClass();
            $cartsData->room_type_id = $id;
            $allCartsData->push($cartsData);
        }

        return $allCartsData;
    }
}
