<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\BookingRequest;
use App\Models\Booking;

class BookingController extends Controller
{

    public function allBookings()
    {
        $pageTitle = 'Booking History';
        $bookings  = Booking::where('user_id', auth()->id())->orderBy('id', 'DESC')->searchable(['booking_number'])->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('Template::user.booking.all', compact('pageTitle', 'bookings'));
    }

    public function bookingRequestList()
    {
        $pageTitle = "All Booking Request";
        $bookingRequests = BookingRequest::where('user_id', auth()->id())
        ->with('roomBookingRequest.roomType')
        ->withCount(['roomBookingRequest as total_rooms' => function($q1){
            $q1->whereHas('roomType', function($q2){
                $q2->where('room_suite', Status::ROOM);
            });
        }, 'roomBookingRequest as total_suites' => function($q3){
            $q3->whereHas('roomType', function($q4) {
                $q4->where('room_suite', Status::SUITE);
            });
        }])
        ->orderBy('id', 'DESC')
        ->paginate(getPaginate());
        return view('Template::user.booking.request', compact('bookingRequests', 'pageTitle'));
    }

    public function cancelBookingRequest($id)
    {
        $bookingRequest = BookingRequest::initial()->where('user_id', auth()->id())->where('id', $id)->first();
        foreach ($bookingRequest->roomBookingRequest as $room) {
            $room->delete();
        }
        $bookingRequest->delete();
        $notify[] = ['success', 'Booking request canceled successfully'];
        return back()->withNotify($notify);
    }

    public function bookingDetails($booking_number)
    {
        $user = auth()->user();
        $booking = Booking::where('booking_number', $booking_number)->where('user_id', $user->id)->with([
            'bookedRooms',
            'bookedRooms.room:id,room_type_id,room_number',
            'bookedRooms.room.roomType:id,name',
            'usedPremiumService.room',
            'usedPremiumService.premiumService',
            'payments'
        ])->first();


        if (blank($booking)) {
            abort(404);
        }

        $pageTitle = 'Booking Details';

        return view('Template::user.booking.details', compact('pageTitle', 'booking'));
    }

    public function payment($id)
    {
        $booking = Booking::findOrFail($id);
        session()->put('amount', getAmount($booking->total_amount - $booking->paid_amount));
        session()->put('booking_id', $booking->id);
        return to_route('user.deposit.index');
    }
}
