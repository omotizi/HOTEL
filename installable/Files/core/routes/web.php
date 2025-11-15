<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

Route::get('cron', 'CronController@cron')->name('cron');

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{id}', 'replyTicket')->name('reply');
    Route::post('close/{id}', 'closeTicket')->name('close');
    Route::get('download/{attachment_id}', 'ticketDownload')->name('download');
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');

Route::controller('CheckoutController')->group(function () {
    Route::post('add-to-list', 'selectRoom')->name('room.select');
    Route::post('selected-room/remove/{id}', 'removeSelectedRoom')->name('selected.room.remove');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::post('checkout', 'checkoutStore')->name('checkout.store');
    Route::post('apply-coupon', 'applyCoupon')->name('apply.coupon');
    Route::post('remove-coupon', 'removeCoupon')->name('remove.coupon');
    Route::get('request/successful/{id}', 'requestSendSuccessful')->name('request.sent.successful');
});

Route::controller('SiteController')->group(function () {
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactSubmit');
    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');

    Route::get('news', 'blog')->name('blog');
    Route::get('news/{slug}', 'blogDetails')->name('blog.details');

    Route::get('rooms-and-suites', 'room')->name('rooms');
    Route::get('room/{slug}', 'roomTypeDetails')->name('room.type.details');
    Route::get('room-search', 'checkRoomAvailability')->name('room.available.search');

    Route::get('compares', 'compare')->name('compare');
    Route::post('compares', 'compareData')->name('compare');

    Route::get('image-gallery', 'gallery')->name('gallery');
    Route::get('video-gallery', 'video')->name('video');

    Route::get('policy/{slug}', 'policyPages')->name('policy.pages');

    Route::get('placeholder-image/{size}', 'placeholderImage')->withoutMiddleware('maintenance')->name('placeholder.image');
    Route::get('maintenance-mode', 'maintenance')->withoutMiddleware('maintenance')->name('maintenance');

    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
    Route::post('subscribe', 'subscribe')->name('subscribe');
});
