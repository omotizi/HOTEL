<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Page;
use App\Models\Room;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\RoomType;
use App\Constants\Status;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use stdClass;

class SiteController extends Controller {
    public function index() {
        $pageTitle   = 'Home';
        $sections    = Page::where('tempname', activeTemplate())->where('slug', '/')->first();
        $seoContents = $sections->seo_content;
        $seoImage = $seoContents?->image ? getImage(getFilePath('seo') . '/' . $seoContents?->image, getFileSize('seo')) : null;
        return view('Template::home', compact('pageTitle', 'sections', 'seoContents', 'seoImage'));
    }

    public function pages($slug) {
        $page        = Page::where('tempname', activeTemplate())->where('slug', $slug)->firstOrFail();
        $pageTitle   = $page->name;
        $sections    = $page->secs;
        $seoContents = $page->seo_content;
        $seoImage    = $seoContents?->image ? getImage(getFilePath('seo') . '/' . $seoContents?->image, getFileSize('seo')) : null;
        return view('Template::pages', compact('pageTitle', 'sections', 'seoContents', 'seoImage'));
    }

    public function contact() {
        $pageTitle   = "Contact Us";
        $user        = auth()->user();
        $sections    = Page::where('tempname', activeTemplate())->where('slug', 'contact')->first();
        $seoContents = $sections->seo_content;
        $seoImage    = $seoContents?->image ? getImage(getFilePath('seo') . '/' . $seoContents?->image, getFileSize('seo')) : null;
        return view('Template::contact', compact('pageTitle', 'user', 'sections', 'seoContents', 'seoImage'));
    }

    public function contactSubmit(Request $request) {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        $request->session()->regenerateToken();

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $random = getNumber();

        $ticket           = new SupportTicket();
        $ticket->user_id  = auth()->id() ?? 0;
        $ticket->name     = $request->name;
        $ticket->email    = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;

        $ticket->ticket     = $random;
        $ticket->subject    = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status     = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title     = 'A new contact message has been submitted';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message                    = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message           = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug) {
        $policy      = Frontend::where('slug', $slug)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle   = $policy->data_values->title;
        $seoContents = $policy->seo_content;
        $seoImage = $seoContents?->image ? frontendImage('policy_pages', $seoContents?->image, getFileSize('seo'), true) : null;
        return view('Template::policy', compact('policy', 'pageTitle', 'seoContents', 'seoImage'));
    }

    public function changeLanguage($lang = null) {
        $language = Language::where('code', $lang)->first();
        if (!$language) {
            $lang = 'en';
        }

        session()->put('lang', $lang);
        return back();
    }

    public function blog() {
        $pageTitle   = 'News & Updates';
        $blogs       = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'blog.element')->orderBy('id', 'desc')->paginate(getPaginate(12));
        $sections    = Page::where('tempname', activeTemplate())->where('slug', 'news')->first();
        $seoContents = $sections->seo_content;
        $seoImage = $seoContents?->image ? getImage(getFilePath('seo') . '/' . $seoContents->image, getFileSize('seo')) : null;
        return view('Template::blog', compact('pageTitle', 'blogs', 'sections', 'seoContents', 'seoImage'));
    }

    public function blogDetails($slug) {
        $blog      = Frontend::where('tempname', activeTemplateName())->where('slug', $slug)->where('data_keys', 'blog.element')->firstOrFail();
        $blogLists = Frontend::where('tempname', activeTemplateName())->where('slug', '!=', $slug)->where('data_keys', 'blog.element')->latest()->limit(10)->get();
        $pageTitle = $blog->data_values->title;

        $seoContents = $blog->seo_content;
        $seoImage    = $seoContents?->image ? frontendImage('blog', $seoContents->image, getFileSize('seo'), true) : null;
        return view('Template::blog_details', compact('blog', 'pageTitle', 'seoContents', 'seoImage', 'blogLists'));
    }

    public function gallery() {
        $pageTitle   = 'Galleries';
        $galleries       = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'gallery.element')->latest()->paginate(getPaginate(50));
        $sections    = Page::where('tempname', activeTemplate())->where('slug', 'gallery')->first();
        $seoContents = $sections->seo_content;
        $seoImage    = $seoContents?->image ? getImage(getFilePath('seo') . '/' . $seoContents?->image, getFileSize('seo')) : null;
        return view('Template::gallery', compact('pageTitle', 'sections', 'seoContents', 'seoImage', 'galleries'));
    }

    public function video() {
        $pageTitle   = 'Videos';
        $videos       = Frontend::where('tempname', activeTemplateName())->where('data_keys', 'video.element')->latest()->paginate(getPaginate(20));
        $sections    = Page::where('tempname', activeTemplate())->where('slug', 'video')->first();
        $seoContents = $sections->seo_content;
        $seoImage    = $seoContents?->image ? getImage(getFilePath('seo') . '/' . $seoContents?->image, getFileSize('seo')) : null;
        return view('Template::video', compact('pageTitle', 'sections', 'seoContents', 'seoImage', 'videos'));
    }

    public function cookieAccept() {
        Cookie::queue('gdpr_cookie', gs('site_name'), 43200);
    }

    public function cookiePolicy() {
        $cookieContent = Frontend::where('data_keys', 'cookie.data')->first();
        abort_if($cookieContent->data_values->status != Status::ENABLE, 404);
        $pageTitle = 'Cookie Policy';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->first();
        return view('Template::cookie', compact('pageTitle', 'cookie'));
    }

    public function subscribe(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|max:255|unique:subscribers',
            ],
            [
                'email.unique' => 'Already subscribed',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $subscriber        = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        $notify[] = ['success', 'Subscribed Successfully'];
        return response()->json(['success' => 'Subscribe successfully']);
    }

    public function placeholderImage($size = null) {
        $imgWidth  = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text      = $imgWidth . '×' . $imgHeight;
        $fontFile  = realpath('assets/font/solaimanLipi_bold.ttf');
        $fontSize  = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgFill);
        $textBox    = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance() {
        $pageTitle = 'Maintenance Mode';
        if (gs('maintenance_mode') == Status::DISABLE) {
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view('Template::maintenance', compact('pageTitle', 'maintenance'));
    }

    public function room(Request $request) {
        $pageTitle = 'Suites & Rooms';
        $request->validate([
            'check_in'  => 'nullable|date_format:Y-m-d|after_or_equal:today',
            'check_out' => 'nullable|date_format:Y-m-d|after:check_in',
            'adult'     => 'nullable|integer',
            'children'  => 'nullable|integer',
            'type'      => 'nullable|in:room,suite'
        ]);

        $searchData = session()->get('search_data');
        $this->initiateValues($request, $searchData);

        $allCompare = Session::get('compare') ?? [];
        $compares   = filterAndExtractIds($allCompare);
        $roomTypes  = RoomType::active()->whereActiveRoom()->with(['images']);
        $roomTypes = $this->roomSearch($roomTypes, $request);

        if ($request->type) {
            $reqType = Str::upper($request->type);
            $roomTypes = $roomTypes->where('room_suite', Status::{$reqType})->get();
        } else {
            $roomTypes = $roomTypes->get();
        }

        session()->put('search_data', [
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'adult'     => $request->adult,
            'children'  => $request->children ?? (isset($searchData['children']) ? $searchData['children'] : 0),
        ]);

        $sections    = Page::where('tempname', activeTemplate())->where('slug', 'rooms-and-suites')->first();
        $seoContents = $sections->seo_content;
        $seoImage    = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;
        return view('Template::room.room', compact('pageTitle', 'sections', 'seoContents', 'seoImage', 'roomTypes', 'compares'));
    }

    private function roomSearch($roomTypes, $request) {
        if ($request->check_in) {
            $roomTypes = $roomTypes->withCount(['rooms as total_rooms' => function ($q) {
                $q->active();
            }])->addSelect(['booked_rooms' => function ($subQuery) use ($request) {
                $subQuery->selectRaw('COUNT(DISTINCT room_id)')
                    ->from('booked_rooms')
                    ->join('rooms', 'booked_rooms.room_id', 'rooms.id')
                    ->where('rooms.status', Status::ENABLE)
                    ->where('booked_rooms.status', Status::ROOM_ACTIVE)
                    ->whereBetween('booked_for', [Carbon::parse($request->check_in)->format('Y-m-d'), Carbon::parse($request->check_out)->format('Y-m-d')])
                    ->whereColumn('booked_rooms.room_type_id', 'room_types.id');
            }])->selectRaw('(SELECT total_rooms - booked_rooms) as available_rooms')->havingRaw('(total_rooms - booked_rooms) > 0');
        }

        if ($request->adult) {
            $roomTypes = $roomTypes->where('total_adult', '>=', $request->adult);
        }

        if ($request->children) {
            $roomTypes = $roomTypes->where('total_child', '>=', $request->children);
        }
        return $roomTypes;
    }

    private function initiateValues($request, $searchData) {
        if (!$request->check_in) {
            $request->merge([
                'check_in' => isset($searchData['check_in']) ? $searchData['check_in'] : Carbon::now()->format('Y-m-d')
            ]);
        }

        if (!$request->check_out) {
            $request->merge([
                'check_out' => isset($searchData['check_out']) ? $searchData['check_out'] : Carbon::parse($request->check_in)->addDay()->format('Y-m-d')
            ]);
        }

        if (!$request->adult) {
            $request->merge([
                'adult' => isset($searchData['adult']) ? $searchData['adult'] : 1
            ]);
        }
    }

    public function roomTypeDetails($slug) {
        $pageTitle = 'Room Details';
        $roomType = RoomType::active()->with('suitesTypeRooms', 'amenities', 'facilities', 'images')->where('slug', $slug)->firstOrFail();

        $moreRoomTypes = RoomType::active()->where('id', '!=', $roomType->id)->where('room_suite', $roomType->room_suite)->whereActiveRoom()->inRandomOrder()->limit(3)->get();

        $searchData = Session::get('search_data');

        Cart::myCart()->whereDate('check_in', '<', now())->orWhereDate('check_out', '<', now())->delete();
        $firstCart = Cart::myCart()->hasRoomType()->with('roomType')->first();

        $checkInDate = $firstCart->check_in ?? (isset($searchData['check_in']) ? $searchData['check_in'] : now()->format('Y-m-d'));
        $checkOutDate = $firstCart->check_out ?? (isset($searchData['check_out']) ? $searchData['check_out'] : now()->addDay()->format('Y-m-d'));


        // SEO
        $seoContents = new stdClass;
        $seoContents->description = strLimit(strip_tags($roomType->description), 100);
        $seoContents->keywords = $roomType->keywords;
        $seoContents->social_title = $roomType->name;
        $seoContents->social_description = strLimit(strip_tags($roomType->description), 100);

        $seoImage = null;
        if(file_exists(getFilePath('roomTypeImage') . '/' . $roomType->main_image)){
            $seoImage    = getImage(getFilePath('roomTypeImage') . '/' . $roomType->main_image, getFileSize('seo'));
        }

        return view('Template::room.details', compact('pageTitle', 'roomType', 'moreRoomTypes', 'checkInDate', 'checkOutDate', 'seoContents', 'seoImage'));
    }

    public function checkRoomAvailability(Request $request) {
        $validator = Validator::make($request->all(), [
            'room_type_id' => 'required|exists:room_types,id',
            'check_in'     => 'required|date_format:Y-m-d|after:yesterday',
            'check_out'    => 'required|date_format:Y-m-d|after:check_in',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $availableRoom = $this->getMinimumAvailableRoom($request);

        if (!$availableRoom) {
            return response()->json(['error' => 'No room available between these dates']);
        }

        return response()->json(['success' => $availableRoom]);
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

    public function compare() {
        if(!View::exists('Template::compare')){
            abort(404);
        }

        $pageTitle    = 'Compares';
        $allCompare   = Session::get('compare') ?? [];
        $compare  = filterAndExtractIds($allCompare);
        $compareRoomTypes  = RoomType::with(['images', 'amenities', 'facilities'])->whereIn('id', $compare)->get();
        return view('Template::compare', compact('pageTitle', 'compareRoomTypes'));
    }

    public function compareData(Request $request) {
        if ($request->id) {
            $requestId   = $request->id;
            $compares    = Session::get('compare') ?? [];

            $modifyCompare = array_filter($compares, function ($item) use ($requestId) {
                return !($item['id'] == $requestId);
            });

            if (count($compares) == count($modifyCompare)) {
                if (count($compares) >= 3) {
                    return response()->json([
                        'message' => 'error',
                        'notify'  => 'Select up to 3 rooms to compare',
                    ]);
                }
                array_push($compares, [
                    "id"  => $request->id,
                ]);
                Session::put('compare', $compares);
            } else {
                Session::put('compare', $modifyCompare);
            }
        }

        $newCompares = Session::get('compare') ?? [];
        $roomCompare  = filterAndExtractIds($newCompares);
        $roomTypes   = RoomType::whereIn('id', $roomCompare ?? [])->get();
        $view = view('Template::partials.compare', compact('roomTypes'))->render();

        return response()->json([
            'message'       => 'success',
            'compare_count' => count($newCompares),
            'view'          => $view,
        ]);
    }
}
