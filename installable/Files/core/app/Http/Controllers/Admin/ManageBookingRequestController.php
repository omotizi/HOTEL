<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Booking;
use App\Constants\Status;
use App\Models\BookedRoom;
use Illuminate\Http\Request;
use App\Models\AppliedCoupon;
use App\Models\BookingRequest;
use App\Traits\BookingActions;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class ManageBookingRequestController extends Controller
{
    use BookingActions;

    public function index()
    {
        $pageTitle       = 'All Booking Request';
        $bookingRequests = $this->bookingRequestData('initial');
        return view('admin.booking.request_list', compact('pageTitle', 'bookingRequests'));
    }

    public function canceledBookings()
    {
        $pageTitle       = 'Canceled Booking Request';
        $bookingRequests = $this->bookingRequestData('canceled');
        return view('admin.booking.canceled_requests', compact('pageTitle', 'bookingRequests'));
    }

    public function cancel($id)
    {
        $bookingRequest = BookingRequest::initial()->findOrFail($id);
        $bookingRequest->status = Status::BOOKING_REQUEST_CANCELED;
        $bookingRequest->save();

        notify($bookingRequest->user, 'BOOKING_REQUEST_CANCELED', [
            'room_type'       => @$bookingRequest->roomType->name,
            'number_of_rooms' => @$bookingRequest->number_of_rooms,
            'check_in'        => showDateTime($bookingRequest->check_in, 'd M, Y'),
            'check_out'       => showDateTime($bookingRequest->check_out, 'd M, Y')
        ]);

        $notify[] = ['success', 'Booking request canceled successfully'];
        return back()->with($notify);
    }

    public function approve(Request $request, $id)
    {
        $bookingRequest = BookingRequest::with('user', 'guest', 'roomBookingRequest', 'roomBookingRequest.roomType:id,name')->findOrFail($id);

        if ($bookingRequest->status == Status::BOOKING_REQUEST_APPROVED) {
            $notify[] = ['error', 'The booking request already approved'];
            return to_route('admin.request.booking.all')->withNotify($notify);
        }

        if ($bookingRequest->status == Status::BOOKING_REQUEST_CANCELED) {
            $notify[] = ['error', 'The booking request has been canceled'];
            return to_route('admin.request.booking.all')->withNotify($notify);
        }

        $pageTitle = "Assign Room";

        $view =  view('partials.requested_room', compact('bookingRequest'))->render();
        return view('admin.booking.request_approve', compact('pageTitle', 'bookingRequest', 'view'));
    }

    public function assignRoom(Request $request)
    {
        $request->validate([
            'booking_request_id' => 'required|exists:booking_requests,id',
            'room'               => 'required|array',
            'paid_amount'        => 'nullable|numeric|gt:0'
        ]);

        $bookingRequest = BookingRequest::with('user','guest', 'roomBookingRequest')->findOrFail($request->booking_request_id);
        $this->bookingRoomValidation($request, $bookingRequest);

        $user = $bookingRequest->user;
        $guest = $bookingRequest->guest;

        $booking                 = new Booking();
        $booking->booking_number = getTrx();
        $booking->user_id        = $user->id ?? 0;
        $booking->guest_id       = $guest->id ?? null;
        $booking->check_in       = $bookingRequest->check_in;
        $booking->check_out      = $bookingRequest->check_out;
        $booking->paid_amount    = $request->paid_amount ?? 0;
        $booking->booking_info   = $bookingRequest->booking_info;
        $booking->total_adult    = $bookingRequest->total_adult;
        $booking->total_child    = $bookingRequest->total_child;
        $booking->coupon_id      = $bookingRequest->coupon_id;
        $booking->coupon_amount  = $bookingRequest->coupon_amount;
        $booking->tax_charge     = $bookingRequest->tax_charge;
        $booking->booking_fare   = $bookingRequest->total_amount;
        $booking->status         = Status::BOOKING_ACTIVE;
        $booking->save();

        $booking->createActionHistory('approve_booking_request');

        if ($request->paid_amount > 0) {
            $booking->createPaymentLog($request->paid_amount, 'RECEIVED');
        }

        $roomIds      = [];
        $bookingRoom  = [];
        $totalBookFare = 0;

        foreach ($request->room as $key => $room) {
            $roomId         = $room['id'];
            $fare           = $room['unit_fare'];
            $bookedFor      = Carbon::parse($room['date'])->format('Y-m-d');
            $room           = Room::with('roomType')->find($roomId);
            $totalBookFare += $room->roomType->fare;
            $taxCharge      = $fare * $bookingRequest->taxPercentage() / 100;

            $bookingRoom[$key]['booking_id']       = $booking->id;
            $bookingRoom[$key]['room_type_id']     = $room->room_type_id;
            $bookingRoom[$key]['room_id']          = $roomId;
            $bookingRoom[$key]['booked_for']       = $bookedFor;
            $bookingRoom[$key]['fare']             = $fare;
            $bookingRoom[$key]['tax_charge']       = $taxCharge;
            $bookingRoom[$key]['cancellation_fee'] = $room->roomType->cancellation_fee;
            $bookingRoom[$key]['status']           = Status::ROOM_ACTIVE;
            $bookingRoom[$key]['created_at']       = now();
            $bookingRoom[$key]['updated_at']       = now();

            array_push($roomIds, $roomId);
        }

        BookedRoom::insert($bookingRoom);

        if($booking->coupon_amount > 0 && $booking->coupon_id){
            $appliedCoupon            = new AppliedCoupon();
            $appliedCoupon->user_id   = $user->id;
            $appliedCoupon->coupon_id = $booking->coupon_id;
            $appliedCoupon->booking_id = $booking->id;
            $appliedCoupon->amount     = $booking->coupon_amount;
            $appliedCoupon->save();
        }

        foreach($bookingRequest->roomBookingRequest as $roomBookReq){
            $roomBookReq->delete();
        }

        $bookingRequest->delete();

        $roomNumbers = Room::whereIn('id', $roomIds)->pluck('room_number')->toArray();
        $rooms       = implode(", ", $roomNumbers);

        notify($user ?? $guest, 'ROOM_BOOKED', [
            'booking_number' => $booking->booking_number,
            'amount'         => showAmount($booking->total_amount, currencyFormat: false),
            'paid_amount'    => showAmount($booking->paid_amount, currencyFormat: false),
            'rooms'          => $rooms,
            'check_in'       => Carbon::parse($booking->check_in)->format('d M, Y'),
            'check_out'      => Carbon::parse($booking->check_out)->format('d M, Y')
        ]);

        $notify[] = ['success', 'Booking request approved successfully'];
        return to_route('admin.request.booking.all')->withNotify($notify);
    }

    private function bookingRoomValidation($request, $bookingRequest)
    {
        $dateWiseRoomTypes = [];

        foreach ($request->room as $reqRoom) {

            //get active room
            $room = Room::with('roomType')->active()->where('id', $reqRoom['id'])->first();
            if (!$room) {
                throw ValidationException::withMessages(['error' => 'Invalid room selected']);
            }
            // checked available or not
            $alreadyBooked = BookedRoom::whereDate('booked_for', $reqRoom['date'])->where('room_id', $room->id)->exists();
            if ($alreadyBooked) {
                throw ValidationException::withMessages(['error' => $room->roomType->name . ' ' . $room->room_number . ' number room has already booked.']);
            }

            $date = Carbon::parse($reqRoom['date'])->format('Y-m-d');
            $data[$date][$reqRoom['type_id']] = 1;

            if (array_key_exists($date, $dateWiseRoomTypes)) {
                if (array_key_exists($reqRoom['type_id'], $dateWiseRoomTypes[$date])) {
                    $dateWiseRoomTypes[$date][$reqRoom['type_id']] += 1;
                } else {
                    $dateWiseRoomTypes[$date][$reqRoom['type_id']] = $data[$date][$reqRoom['type_id']];
                }
            } else {
                $dateWiseRoomTypes[$date] = [$reqRoom['type_id'] => $data[$date][$reqRoom['type_id']]];
            }
        }


        foreach ($bookingRequest->roomBookingRequest as $roomBookingReq) {
            $startDate = Carbon::parse($roomBookingReq->check_in)->startOfDay();
            $endDate = Carbon::parse($roomBookingReq->checkout)->startOfDay();
            while ($startDate < $endDate) {
                $currentDate = $startDate->copy();
                if (@$dateWiseRoomTypes[$currentDate->format('Y-m-d')][$roomBookingReq->room_type_id] != $roomBookingReq->quantity) {
                    throw ValidationException::withMessages(['error' => 'Room quantity not matched with requested quantity']);
                }
                $startDate->addDay();
            }
        }
    }

    protected function bookingRequestData($scope)
    {
        $query = BookingRequest::$scope()->searchable(['user:username,email', 'roomBookingRequest:roomType:name'])->with('user', 'roomBookingRequest.roomType')->latest()->paginate(getPaginate());
        return $query;
    }

    public function deleteAll(){
        BookingRequest::canceled()->delete();
        $notify[] = ['success', 'All canceled requests deleted successfully'];
        return back()->withNotify($notify);
    }
}
