<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use Carbon\Carbon;
use App\Models\Guest;
use App\Models\User;
use App\Models\Cart;
use App\Models\Room;
use App\Models\Coupon;
use App\Models\RoomType;
use App\Models\UserLogin;
use App\Lib\CouponManager;
use App\Models\BookingRequest;
use App\Models\AdminNotification;
use App\Models\RoomBookingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CheckoutController extends Controller {
    public function checkout() {
        $pageTitle = "Checkout";
        $carts     = Cart::myCart();
        $cartCount = (clone $carts)->count();

        if (!$cartCount) {
            $notify[] = ['info', 'There is no selected room.'];
            return to_route('rooms')->withNotify($notify);
        }

        $info        = json_decode(json_encode(getIpInfo()), true);
        $mobileCode  = @implode(',', $info['code']);
        $countries   = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        $cartTotalPrice     = (clone $carts)->sum('total_fare');
        $discountAmount     = 0;
        $totalTax           = 0;
        $totalAmountWithTax = 0;
        $couponCode         = '';

        if (session('apply_coupon')) {
            $discountAmount = session('apply_coupon')['discount_amount'];
            $totalAmountAfterDiscount = ((float)$cartTotalPrice - $discountAmount);
            $totalTax = ($totalAmountAfterDiscount * gs('tax') / 100);
            $totalAmountWithTax = ($totalAmountAfterDiscount + $totalTax);
            $couponCode = session('apply_coupon')['coupon_code'];
        } else {
            $totalTax = $cartTotalPrice * gs('tax') / 100;
            $totalAmountWithTax = ((float)$cartTotalPrice + $totalTax);
        }

        $carts = Cart::with('roomType')->whereNotNull('room_type_id')->myCart()->get();
        return view('Template::checkout', compact('pageTitle', 'mobileCode', 'countries', 'cartCount', 'carts', 'cartTotalPrice', 'totalTax', 'totalAmountWithTax', 'discountAmount', 'couponCode'));
    }

    public function checkoutStore(Request $request) {
        $this->validateCheckout($request);

        if ($request->create_account == Status::YES) {
            $this->registrationValidation($request);
        }

        $carts = Cart::myCart()->with('roomType')->get();

        if (!$carts->count()) {
            $notify[] = ['error', 'Your cart is empty'];
            return back()->withNotify($notify);
        }

        $user = auth()->user();
        $guest = null;

        if(!$user && $request->create_account == Status::NO){
           $guest = $this->addGuest($request);
        }elseif(!$user && $request->create_account == Status::YES){
            $user = $this->addUser($request);
        }

        $bookingInfo = [
            "name"            => $user ? $user->fullname : $guest->name,
            "email"           => $request->email,
            "country"         => $request->country,
            "dial_code"       => $request->mobile_code,
            "mobile"          => $request->mobile_code . $request->mobile,
            "arrival"         => $request->arrival,
            "departure"       => $request->departure,
            "special_request" => $request->special_request
        ];

        $totalPrice  = $carts->sum('total_fare');
        $totalAdult  = 0;
        $totalChild  = 0;

        $appliedCouponInfo = session('apply_coupon');
        $coupon = null;
        $couponAmount = 0;
        if ($appliedCouponInfo) {
            $couponManager = new CouponManager();
            $coupon = $couponManager->getCouponByCode($appliedCouponInfo['coupon_code']);

            if (!$coupon) {
                $notify[] = ['error', 'Applied coupon is invalid or expired'];
                return back()->withNotify($notify);
            }

            $couponAmount = $appliedCouponInfo['discount_amount'] ?? 0;
            session()->forget('apply_coupon');
        }

        $totalCharge = ($totalPrice - $couponAmount) * gs('tax') / 100;

        $bookingRequest                     = new BookingRequest();
        $bookingRequest->user_id            = $user->id ?? 0;
        $bookingRequest->guest_id           = $guest->id ?? 0;
        $bookingRequest->booking_info       = $bookingInfo;
        $bookingRequest->amount             = $totalPrice;
        $bookingRequest->tax_charge         = $totalCharge;
        $bookingRequest->total_amount       = $totalPrice - $couponAmount;
        $bookingRequest->coupon_id          = $coupon->id ?? 0;
        $bookingRequest->coupon_amount      = $couponAmount;
        $bookingRequest->save();

        foreach ($carts as $roomCart) {
            $roomBookingRequest                     = new RoomBookingRequest();
            $totalAdult += $roomCart->adult;
            $totalChild += $roomCart->children;
            $roomBookingRequest->booking_request_id = $bookingRequest->id;
            $roomBookingRequest->check_in           = $roomCart->check_in;
            $roomBookingRequest->check_out          = $roomCart->check_out;
            $roomBookingRequest->room_type_id       = $roomCart->room_type_id;
            $roomBookingRequest->adult              = $roomCart->adult;
            $roomBookingRequest->children           = $roomCart->children;
            $roomBookingRequest->quantity           = $roomCart->quantity;
            $roomBookingRequest->unit_fare          = $roomCart->fare;
            $roomBookingRequest->total_fare         = $roomCart->total_fare;
            $roomBookingRequest->save();
        }

        $bookingDateCheck = RoomBookingRequest::where('booking_request_id', $bookingRequest->id);
        $bookingCheckIn   = (clone $bookingDateCheck)->orderBy('check_in', 'asc')->first();
        $bookingCheckOut  = (clone $bookingDateCheck)->orderBy('check_out', 'desc')->first();

        $bookingRequest->check_in    = $bookingCheckIn->check_in;
        $bookingRequest->check_out   = $bookingCheckOut->check_out;
        $bookingRequest->total_adult = $totalAdult;
        $bookingRequest->total_child = $totalChild;
        $bookingRequest->save();

        foreach ($carts as $cart) {
            $cart->delete();
        }

        session()->forget('room_cart');

        $notify[] = ['success', 'Booking request send successfully'];
        return to_route('request.sent.successful', encrypt($bookingRequest->id))->withNotify($notify);
    }

    public function requestSendSuccessful($id){
        try {
            $id = decrypt($id);
            $bookingRequest = BookingRequest::with('user', 'guest', 'roomBookingRequest.roomType')->findOrFail($id);
            $pageTitle = 'Confirmation';
            return view('Template::confirmation', compact('pageTitle', 'bookingRequest'));
        } catch (\Exception $e) {
            $notify[] = ['error', 'Invalid request'];
            return to_route('home')->withNotify($notify);
        }
    }

    protected function validateCheckout($request) {
        $countryData  = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes  = implode(',', array_column($countryData, 'dial_code'));
        $countries    = implode(',', array_column($countryData, 'country'));

        $rules = [
            'create_account'     => 'nullable|in:1',
            'firstname'          => 'required',
            'lastname'           => 'required',
            'email'              => 'required|email',
            'country_code'       => 'required|in:' . $countryCodes,
            'country'            => 'required|in:' . $countries,
            'mobile_code'        => 'required|in:' . $mobileCodes,
            'mobile'             => ['required', 'regex:/^([0-9]*)$/'],
            'address'            => 'required',
            'acknowledgement'    => 'required',
            'special_request'    => 'nullable|string',
            'arrival'            => 'nullable|date_format:H:i',
            'departure'          => 'nullable|date_format:H:i',
        ];

        $request->validate($rules);
    }

    protected function registrationValidation($request) {
        $passwordValidation = Password::min(6);
        if (gs('secure_password')) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $request->validate([
            'email' => 'required|string|email|unique:users',
            'mobile' => ['required', 'regex:/^([0-9]*)$/', Rule::unique('users')->where('dial_code', $request['mobile_code'])],
            'password' => ['required', 'confirmed', $passwordValidation],
        ]);
    }

    private function addGuest($request){
        $guest = new Guest();
        $guest->name = $request->firstname. ' '.  $request->lastname;
        $guest->email = $request->email;
        $guest->mobile = $request->moible_code. $request->mobile;
        $guest->address = $request->address;
        $guest->save();

        return $guest;
    }

    private function addUser($request) {
        $user                   = new User();
        $user->email            = strtolower($request->email);
        $user->firstname        = $request->firstname;
        $user->lastname         = $request->lastname;
        $user->password         = Hash::make($request->password);
        $user->country_code     = $request->country_code;
        $user->mobile           = $request->mobile;
        $user->dial_code        = $request->mobile_code;
        $user->country_name     = $request->country;
        $user->address          = $request->address;
        $user->ev               = gs('ev') ? Status::NO : Status::YES;
        $user->sv               = gs('sv') ? Status::NO : Status::YES;
        $user->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'New member registered';
        $adminNotification->click_url = urlPath('admin.users.detail', $user->id);
        $adminNotification->save();

        $ip        = getRealIP();
        $exist     = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        if ($exist) {
            $userLogin->longitude    = $exist->longitude;
            $userLogin->latitude     = $exist->latitude;
            $userLogin->city         = $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country      = $exist->country;
        } else {
            $info                    = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude    = @implode(',', $info['long']);
            $userLogin->latitude     = @implode(',', $info['lat']);
            $userLogin->city         = @implode(',', $info['city']);
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country      = @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip = $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os      = @$userAgent['os_platform'];
        $userLogin->save();

        Auth::login($user);
        return $user;
    }

    public function selectRoom(Request $request) {
        $validator = Validator::make($request->all(), [
            'room_type_id'    => 'required|exists:room_types,id',
            'check_in'        => 'required|date_format:Y-m-d|after:yesterday',
            'check_out'       => 'nullable|date_format:Y-m-d|after_or_equal:check_in',
            'number_of_rooms' => 'required|integer|gt:0',
            'adult'           => 'required|integer|gt:0',
            'children'        => 'required|integer|gte:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        $roomType = RoomType::active()->find($request->room_type_id);
        if (!$roomType) {
            return response()->json([
                'status' => false,
                'errors' => 'Room type not found.'
            ]);
        }

        $availableRoom = $this->getMinimumAvailableRoom($request);
        $cartExit = Cart::myCart();

        $alreadyInCart = (clone $cartExit)->where('room_type_id', $roomType->id)->exists();
        if ($alreadyInCart) {
            return response()->json([
                'status' => false,
                'errors' => 'This room is already added.'
            ]);
        }

        if ($request->number_of_rooms > $availableRoom) {
            return response()->json([
                'status' => false,
                'errors' => 'We have ' . $availableRoom . ' rooms available for booking.'
            ]);
        }

        $dateMismatched = (clone $cartExit)->where(function ($query) use ($request) {
            $query->where('check_in', '!=', $request->check_in)->orWhere('check_out', '!=', $request->check_out);
        })->first();

        if ($dateMismatched) {
            return response()->json([
                'status' => false,
                'errors' => 'The check-in and checkout date should matched with previous selection.'
            ]);
        }


        if ($request->adult > $roomType->total_adult * $request->number_of_rooms) {
            return response()->json([
                'status' => false,
                'errors' => 'The number of adults exceeds the maximum allowed for the selected room type.'
            ]);
        }

        if ($request->children > $roomType->total_child * $request->number_of_rooms) {
            return response()->json([
                'status' => false,
                'errors' => 'The number of children exceeds the maximum allowed for the selected room type.'
            ]);
        }

        $cart = new Cart();

        if (auth()->check()) {
            $cart->user_id = auth()->id();
        } else {
            $cart->session_uid = getTrx();
            $sessionCart = session()->get('room_cart', []);
            $sessionCart[] = $cart->session_uid;
            session()->put('room_cart', $sessionCart);
        }

        $cart->room_type_id = $roomType->id;
        $cart->quantity     = $request->number_of_rooms;
        $cart->check_in     = $request->check_in;
        $cart->check_out    = $request->check_out;
        $cart->adult        = $request->adult;
        $cart->children     = $request->children;
        $cart->fare         = $roomType->roomFare();
        $cart->total_fare   = $roomType->roomFare() * daysDifference($request->check_in, $request->check_out) * $request->number_of_rooms;
        $cart->save();

        if (!session()->has('search_data')) {
            session()->put('search_data', [
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'adult' => $request->adult ?? 1,
                'children' => $request->children ?? 0,
            ]);
        }

        if (session('apply_coupon')) {
            session()->forget('apply_coupon');
        }

        $totalAmount = Cart::myCart()->sum('total_fare');
        $totalRooms  = Cart::mycart()->sum('quantity');

        return response()->json([
            'status' => true,
            'message' => 'Room selected successfully',
            'data' => [
                'total_rooms' => $totalRooms,
                'total_amount' => showAmount($totalAmount)
            ]
        ]);
    }

    public function removeSelectedRoom($id) {
        $cart = Cart::myCart()->find($id);
        if (blank($cart)) {
            return response()->json([
                'status' => 'error',
                'message'   => 'Invalid Cart',
            ]);
        }
        $sessionCarts = Session()->get('room_cart') ??  [];
        $sessionCarts = array_filter($sessionCarts, function ($sessionCart) use ($cart) {
            return $sessionCart !== $cart->session_uid;
        });

        Session()->put('room_cart', $sessionCarts);
        $cart->delete();

        $notify[] = ['success', 'Item removed successfully'];
        return back()->withNotify($notify);
    }

    protected function getMinimumAvailableRoom($request) {
        $checkInDate           = Carbon::parse($request->check_in);
        $checkOutDate          = Carbon::parse($request->check_out);
        $dateWiseAvailableRoom = [];

        for ($checkInDate; $checkInDate < $checkOutDate; $checkInDate->addDays()) {
            $checkIn = $checkInDate->format('Y-m-d');
            $bookedRooms = Room::where('room_type_id', $request->room_type_id)
                ->whereHas('booked', function ($booked) use ($checkIn) {
                    $booked->active()->whereDate('booked_for', $checkIn);
                })->get('id')->toArray();

            $dateWiseAvailableRoom[] = Room::active()->where('room_type_id', $request->room_type_id)->whereNotIn('id', $bookedRooms)->count();
        }
        return min($dateWiseAvailableRoom);
    }

    public function applyCoupon(Request $request) {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $totalCartAmount = Cart::myCart()->sum('total_fare');

        if (!$totalCartAmount) {
            return response()->json([
                'status'  => 'error',
                'message' => ['error' => 'Invalid Cart']
            ]);
        }

        $userPerLimitCoupon = Coupon::where('usage_limit_per_user', '>', 0)->where('coupon_code', $request->coupon_code)->first();
        if ($userPerLimitCoupon && !auth()->check()) {
            return response()->json([
                'status'  => 'error',
                'message' => ['error' => 'Login is required to use the coupon code ' . $request->coupon_code],
            ]);
        }

        $user = auth()->user();
        $couponManager = new CouponManager();
        $coupon = $couponManager->getCouponByCode($request->coupon_code, $user);

        if (!$coupon) {
            return response()->json([
                'status'  => 'error',
                'message' => ['error' => 'Applied coupon is invalid or expired'],
            ]);
        }

        $checkCoupon = $couponManager->isValidCoupon($coupon, $totalCartAmount, true);
        if (isset($checkCoupon['error'])) {
            return response()->json([
                'status'  => 'error',
                'message' => $checkCoupon,
            ]);
        }

        $discountAmount = $coupon->discountAmount($totalCartAmount);
        $totalAmountAfterDiscount = ((float)$totalCartAmount - $discountAmount);
        $totalTax = ($totalAmountAfterDiscount * gs('tax') / 100);
        $totalAmountWithTax = $totalAmountAfterDiscount + $totalTax;

        session()->put('apply_coupon', [
            'coupon_code' => $request->coupon_code,
            'cart_amount' => $totalCartAmount,
            'discount_amount' => $discountAmount,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => ['success' => 'Coupon apply successfully'],
            'coupon_code' => $request->coupon_code,
            'discount_amount' => showAmount($discountAmount),
            'total_tax' => showAmount($totalTax),
            'total_amount_with_text' => showAmount($totalAmountWithTax),
        ]);
    }

    public function removeCoupon() {
        if (session('apply_coupon')) {
            session()->forget('apply_coupon');
        }

        $totalCartAmount = Cart::myCart()->sum('total_fare');
        $totalTax = ($totalCartAmount * gs('tax') / 100);
        $totalAmountWithTax = $totalCartAmount + $totalTax;

        return response()->json([
            'status'  => 'success',
            'message' => ['success' => 'Coupon removed successfully'],
            'total_tax' => showAmount($totalTax),
            'total_amount_with_tax' => showAmount($totalAmountWithTax),
            'coupon_amount' => showAmount(0)
        ]);
    }
}
