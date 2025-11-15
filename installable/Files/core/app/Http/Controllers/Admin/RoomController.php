<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index($suiteTypeId)
    {
        $roomType = RoomType::with('rooms')->findOrFail($suiteTypeId);
        $pageTitle = 'Rooms - ' . $roomType->name;
        $rooms =  Room::where('room_type_id', $roomType->id)->orderBy('room_number', 'asc')->paginate(getPaginate());
        return view('admin.hotel.rooms', compact('pageTitle', 'rooms', 'roomType'));
    }

    public function addRoom(Request $request, $roomTypeId, $id = 0)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
        ]);

        $roomType = RoomType::findOrFail($roomTypeId);

        if ($id) {
            $room    = Room::findOrFail($id);
            $message = 'Room updated successfully';
        } else {
            $room    = new Room();
            $message = 'Room create successfully';
        }

        $room->room_type_id = $roomType->id;
        $room->room_number  = $request->room_number;
        $room->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }


    public function status($id)
    {
        $room = Room::findOrFail($id);
        $room->status = $room->status == Status::ENABLE ? Status::DISABLE : Status::ENABLE;
        $room->save();

        $notify[] = ['success', 'Status updated successfully'];
        return back()->withNotify($notify);
    }
}
