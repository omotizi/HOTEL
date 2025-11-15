<?php

namespace App\Traits;

use App\Models\Room;
use App\Models\SuitesRoom;
use Illuminate\Http\Request;
use Carbon\Carbon;

trait BookingActions
{
    private function getRooms(Request $request)
    {
        $checkIn = Carbon::parse($request->checkin_date);
        $checkOut = $request->checkout_date ? Carbon::parse($request->checkout_date) : $checkIn;
        $numberOfRooms = $request->rooms;
        $rooms = null;

        $rooms = Room::active()
            ->where('room_type_id', $request->room_type)
            ->with([
                'booked' => function ($q) {
                    $q->active();
                },
                'roomType' => function ($q) {
                    $q->select('id', 'name', 'fare');
                }
            ])
            ->get();

        if (count($rooms) < $numberOfRooms) {
            return ['error' => ['The requested number of rooms is not available for the selected date']];
        }
        return view('partials.rooms', compact('checkIn', 'checkOut', 'rooms', 'numberOfRooms'))->render();
    }
}
