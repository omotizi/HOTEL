<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class AmenitiesController extends Controller {
    public function index() {
        $pageTitle = 'All Amenities';
        $amenities = Amenity::orderBy('title')->Paginate(getPaginate());
        return view('admin.hotel.amenities', compact('pageTitle', 'amenities'));
    }

    public function save(Request $request, $id = 0) {
        $request->validate([
            'title'     => 'required|string|unique:amenities,title,' . $id,
            'image'      => [ $id ? 'nullable' : 'required', new FileTypeValidate(['jpg', 'jpeg', 'png']) ],
        ]);

        if ($id) {
            $amenities          = Amenity::findOrFail($id);
            $notification       = 'Amenity updated successfully';
        } else {
            $amenities          = new Amenity();
            $notification       = 'Amenity added successfully';
        }

        $amenities->title   = $request->title;
        if ($request->hasFile('image')) {
            $amenities->image = fileUploader($request->image, getFilePath('amenity'), getFileSize('amenity'), $amenities->image);
        }

        $amenities->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return Amenity::changeStatus($id);
    }
}
