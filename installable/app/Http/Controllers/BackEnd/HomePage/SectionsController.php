<?php

namespace App\Http\Controllers\BackEnd\HomePage;

use App\Http\Controllers\Controller;
use App\Models\HomePage\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SectionsController extends Controller
{
  public function sections()
  {
    $data['sections'] = HomeSection::first();

    return view('backend.home_page.sections', $data);
  }

  public function updatesections(Request $request)
  {
    $settings = DB::table('basic_settings')->select('theme_version')->first();
    $sections = HomeSection::firstOrFail();

    $sections->search_section = $request->search_section;
    $sections->intro_section = $request->has('intro_section') ? $request->intro_section : 1;
    $sections->featured_rooms_section = $request->has('featured_rooms_section') ?  $request->featured_rooms_section : 1;
    $sections->featured_services_section = $request->has('featured_services_section') ? $request->featured_services_section : 1;

  
      $sections->faq_section = $request->has('faq_section') ? $request->faq_section : 1;
      $sections->blogs_section = $request->has('blogs_section') ? $request->blogs_section : 1;
    

    $sections->statistics_section = $request->has('statistics_section') ? $request->statistics_section : 1;
    $sections->video_section = $request->has('video_section') ? $request->video_section : 1;
    $sections->featured_package_section = $request->has('featured_package_section') ?$request->featured_package_section : 1;

      $sections->facilities_section = $request->has('facilities_section') ? $request->facilities_section : 1;
    

     $sections->package_feature_setion = $request->has('package_feature_setion') ? $request->package_feature_setion : 1;
     $sections->latest_package_section = $request->has('latest_package_section') ? $request->latest_package_section : 1;

     $sections->room_feature_section =  $request->has('room_feature_section') ? $request->room_feature_section : 1;
     $sections->latest_room_section = $request->has('latest_room_section') ? $request->latest_room_section : 1;

     $sections->service_section = $request->has('service_section') ? $request->service_section : 1;

    $sections->testimonials_section = $request->has('testimonials_section') ? $request->testimonials_section : 1;
    $sections->brand_section = $request->has('brand_section') ? $request->brand_section : 1;
    $sections->top_footer_section =  $request->has('top_footer_section') ? $request->top_footer_section : 1;
    $sections->copyright_section = $request->has('copyright_section') ? $request->copyright_section : 1;
    $sections->save();

    Session::flash('success', 'Sections customized successfully!');

    return back();
  }
}
