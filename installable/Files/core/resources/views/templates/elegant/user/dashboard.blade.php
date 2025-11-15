@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="notice"></div>

        @if (!$bookings->count() && !$bookingRequests->count())
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 0C10.7656 0 0 10.7656 0 24C0 37.2344 10.7656 48 24 48C37.2344 48 48 37.2344 48 24C48 10.7656 37.2344 0 24 0ZM24 4C35.0703 4 44 12.9297 44 24C44 35.0703 35.0703 44 24 44C12.9297 44 4 35.0703 4 24C4 12.9297 12.9297 4 24 4ZM15 16C13.3438 16 12 17.3438 12 19C12 20.6562 13.3438 22 15 22C16.6562 22 18 20.6562 18 19C18 17.3438 16.6562 16 15 16ZM33 16C31.3438 16 30 17.3438 30 19C30 20.6562 31.3438 22 33 22C34.6562 22 36 20.6562 36 19C36 17.3438 34.6562 16 33 16ZM14 32V36H34V32H14Z" fill="#1A1A1A" />
                        </svg>
                        <h4 class="mt-2 mb-1">@lang('No Bookings Yet.')</h4>
                        <p class="fs-20">@lang('Book now and enjoy the benefits.') <a href="{{ route('rooms') }}">@lang('Click here.')</a></p>
                    </div>
                </div>
            </div>
        @endif

        @if ($bookings->count())
            <div class="reservation-section">
                <div class="style-left d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <h4 class="section-heading__title mb-0">@lang('Recent Bookings')</h4>
                    <a class="btn btn--base" href="{{ route('user.booking.all') }}">@lang('Booking History')</a>
                </div>
                @include('Template::partials.booking_history_table')
            </div>
        @endif

        @if ($bookingRequests->count())
            <div class="reservation-section mt-5">
                <div class="style-left d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <h4 class="section-heading__title mb-0"> @lang('Booking Requests') </h4>
                    <a class="btn btn--base" href="{{ route('user.booking.request.all') }}">@lang('All Booking Request ')</a>
                </div>

                @include('Template::partials.booking_request_table')
        @endif
    </div>

    @if ($bookingRequests->count())
        <x-confirmation-modal :web=true />
    @endif
@endsection
