<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Constants\Status;
use App\Models\SuitesRoom;
use App\Models\SuitesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuitesRoomController extends Controller
{
    public function index()
    {
        $pageTitle = 'All Suites Rooms';
        $roomTypes = SuitesType::get();
        $rooms     = SuitesRoom::searchable(['suites_number', 'suitesType:name'])->with('suitesType')->paginate(getPaginate());
        return view('admin.hotel.suites_rooms', compact('pageTitle', 'rooms', 'roomTypes'));
    }

    public function addRoom(Request $request, $id = 0)
    {
        $roomFiled = $id ? 'suites_number' : 'suites_numbers';

        $request->validate([
            'suites_types_id' => 'required|exists:suites_types,id',
            "$roomFiled"   => 'required'
        ]);

        if ($id) {
            $existsRoom = SuitesRoom::where('suites_number', $request->suites_number)->where('id', '!=', $id)->exists();
        } else {
            $existsRoom = SuitesRoom::whereIn('suites_number', $request->suites_numbers)->count();
        }

        if ($existsRoom) {
            $notify[] = ['error', "The requested suites room number already exists"];
            return back()->withNotify($notify);
        }

        if ($id) {
            $room = SuitesRoom::findOrFail($id);
            $room->suites_types_id = $request->suites_types_id;
            $room->suites_number  = $request->suites_number;
            $room->save();
            $message = 'Suites Room updated successfully';
        } else {
            foreach ($request->suites_numbers as $roomNumber) {
                $room = new SuitesRoom();
                $room->suites_types_id = $request->suites_types_id;
                $room->suites_number = $roomNumber;
                $room->save();
            }
            $message = 'Suites Room added successfully';
        }

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        $room = SuitesRoom::findOrFail($id);
        $room->status = $room->status == Status::ENABLE ? Status::DISABLE : Status::ENABLE;
        $room->save();

        $notify[] = ['success', 'Status updated successfully'];
        return back()->withNotify($notify);
    }
}
