<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\RoomType;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller {
    public function index() {

        $pageTitle = "All Offers";
        $offers    = Offer::withCount('roomTypes as total_roomTypes')->searchable(['name'])->latest()->paginate(getPaginate());
        return view('admin.offers.index', compact('pageTitle', 'offers'));
    }

    public function create() {
        $pageTitle = "Create New Offer";
        return view('admin.offers.create', compact('pageTitle'));
    }

    public function save(Request $request, $id) {
        $request->validate([
            "offer_name"     => 'required|string|max:40',
            "discount_type"  => 'required|in:1,2',
            "amount"         => 'required|numeric',
            "starts_from"    => 'required|date|date_format:Y-m-d h:i A',
            "ends_at"        => 'required|date|date_format:Y-m-d h:i A|after:starts_from',
            "room_types"     => 'nullable|array|min:1',
            "room_types.*"   => 'required_with:products|exists:room_types,id',
            'banner'         => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ]);

        if ($request->discount_type == Status::DISCOUNT_PERCENT && $request->amount > 100) {
            $notify[] = ['error', 'Offer amount percentage can\'t be greater than 100%'];
            return back()->withNotify($notify);
        }

        $roomTypeToRemove = [];

        if ($id == 0) {
            $offer    = new Offer();
            $notify[] = ['success', 'Offer created successfully'];
            $roomTypesToAdd = $request->room_types ?? [];
        } else {
            $offer    = Offer::findOrFail($id);
            $notify[] = ['success', 'Offer updated successfully'];

            $previousRoomTypes = $offer->roomTypes->pluck('id')->toArray();
            $newRoomTypes = $request->room_types ?? [];

            // Find products to remove from offer
            $roomTypeToRemove = array_diff($previousRoomTypes, $newRoomTypes);

            // Find products to add to offer
            $roomTypesToAdd = array_diff($newRoomTypes, $previousRoomTypes);
        }

        $offer->name           = $request->offer_name;
        $offer->discount_type  = $request->discount_type;
        $offer->amount         = $request->amount;
        $offer->starts_from    = $request->starts_from;
        $offer->ends_at        = $request->ends_at;
        $offer->save();

        RoomType::whereIn('id', $roomTypeToRemove)->update(['offer_id' => 0]);
        RoomType::whereIn('id', $roomTypesToAdd)->update(['offer_id' => $offer->id]);
        return back()->withNotify($notify);
    }

    public function edit($id) {
        $pageTitle = "Edit Offer";
        $offer     = Offer::with(['roomTypes'])->findOrFail($id);
        return view('admin.offers.create', compact('pageTitle', 'offer'));
    }

    public function roomTypeForOffer(Request $request) {
        $validator = Validator::make($request->all(), [
            'search' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $products = RoomType::searchable(['name'])
            ->active()
            ->whereActiveRoom()
            ->orderBy('id', 'desc')
            ->paginate(30)
            ->withQueryString();

        return response()->json($products);
    }

    public function status($id)
    {
        return Offer::changeStatus($id);
    }
}
