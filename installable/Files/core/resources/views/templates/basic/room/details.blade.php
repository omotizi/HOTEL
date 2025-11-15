@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="section">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-8">
                    <div class="room-details-head">
                        <div>
                            <h2 class="title">{{ __($roomType->name) }}</h2>
                            <div class="d-flex flex-wrap gap-3">
                                <span>
                                    @lang('Adult') &nbsp; {{ $roomType->total_adult }}
                                </span>

                                <span>
                                    @lang('Child') &nbsp; {{ $roomType->total_child }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="price-wrapper">
                                <h2 class="text--danger fare main-fare"> <del> {{ gs('cur_sym') . showAmount($roomType->fare, currencyFormat: false) }} </del></h2>
                                <h2 class="text--base fare">{{ showAmount($roomType->roomFare()) }}</h2>
                            </div>
                            <div class="text-end">
                                <span class="text--small">+{{ gs()->tax }}% {{ __(gs()->tax_name) }}</span>
                                <span class="text--base text-sm"> / @lang('Night')</span>
                            </div>
                        </div>
                    </div>

                    <div class="room-details-thumb-slider">
                        <div class="single-slide">
                            <div class="room-details-thumb">
                                <img alt="image" src="{{ getImage(getFilePath('roomTypeImage') . '/' . $roomType->main_image, getFileSize('roomTypeImage')) }}">
                            </div>
                        </div>
                        @foreach ($roomType->images as $roomTypeImage)
                            <div class="single-slide">
                                <div class="room-details-thumb">
                                    <img alt="image" src="{{ getImage(getFilePath('roomTypeImage') . '/' . $roomTypeImage->image, getFileSize('roomTypeImage')) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    

                    @if ($roomType->images->count() > 1)
                        <div class="room-details-nav-slider mt-4">
                            <div class="single-slide">
                                <div class="room-details-nav-thumb">
                                    <img alt="image" src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . $roomType->main_image, getFileSize('roomTypeImage')) }}">
                                </div>
                            </div>
                            @foreach ($roomType->images as $roomTypeImage)
                                <div class="single-slide">
                                    <div class="room-details-nav-thumb">
                                        <img alt="image" src="{{ getImage(getFilePath('roomTypeImage') . '/' . $roomTypeImage->image, getFileSize('roomTypeImage')) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="room-details-card mt-4">
                        <h5 class="title">@lang('Description')</h5>
                        <div class="body"> @php echo $roomType->description;@endphp </div>
                    </div>

                    <div class="room-details-card mt-4">
                        <h5 class="title">@lang('Check-In Time & Checkout Time')</h5>

                        <div class="body">
                            <div class="d-inline-flex flex-md-row flex-column gap-md-5 flex-wrap gap-3">
                                <span class="me-2">
                                    <i class="las la-door-closed"></i> @lang('Check-In'):
                                    {{ showDateTime(gs()->checkin_time, 'H:i A') }}
                                </span>
                                <span class="me-2">
                                    <i class="las la-door-open"></i> @lang('Checkout'):
                                    {{ showDateTime(gs()->checkout_time, 'H:i A') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="room-details-card mt-4">
                        <h5 class="title">@lang('Cancellation Policy')</h5>

                        <div class="body">
                            @if ($roomType->cancellation_fee == 0)
                                <span> <i class="las la-check-double"></i> @lang('Free Cancellation')</span>
                            @else
                                <h5 class="text-center">@lang('Cancellation Fee') {{ showAmount($roomType->cancellation_fee) }} / @lang('Night')</h5>
                            @endif

                            <div class="mt-2">@php echo $roomType->cancellation_policy; @endphp</div>
                        </div>
                    </div>

                    @if ($roomType->amenities->count())
                        <div class="room-details-card mt-4">
                            <h5 class="title">@lang('Amenities')</h5>

                            <div class="body">
                                <div class="d-inline-flex flex-md-row flex-column gap-md-5 flex-wrap gap-3">
                                    @foreach ($roomType->amenities as $amenity)
                                        <div class="item-wrapper">
                                            <span class="image">
                                                <img src="{{ getImage(getFilePath('amenity'). '/'. $amenity->image, getFileSize('amenity')) }}" alt="">
                                            </span>
                                            <span class="name">
                                                {{ __($amenity->title) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($roomType->facilities->count())
                        <div class="room-details-card mt-4">
                            <h5 class="title">@lang('Facilities')</h5>
                            <div class="body">
                                <div class="d-inline-flex flex-md-row flex-column gap-md-5 flex-wrap gap-3">
                                    @foreach ($roomType->facilities as $facility)
                                        <div class="item-wrapper">
                                            <span class="image">
                                                <img src="{{ getImage(getFilePath('facility'). '/'. $facility->image, getFileSize('facility')) }}" alt="">
                                            </span>
                                            <span class="name">
                                                {{ __($facility->title) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($roomType->beds)
                        <div class="room-details-card mt-4">
                            <h5 class="title">@lang('Beds')</h5>
                            <div class="body">
                                <div class="d-inline-flex flex-md-row flex-column gap-md-5 flex-wrap gap-3">
                                    @foreach ($roomType->beds as $bed)
                                        <span class="me-2"><i class="las la-check-double"></i> {{ __($bed) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <form class="book-form" method="post">
                        <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
                        <div class="room-booking-sidebar">
                            <div class="room-booking-widget">
                                <div class="room-booking-widget__body mt-0">
                                    <div class="mb-3">
                                        <label for="check_in" class="fw-bold">@lang('Check-In')</label>
                                        <div class="custom-icon-field">
                                            <input autocomplete="off" class="check-in-date form--control" data-date-format="yyyy-mm-dd" data-language="en" data-position='top left' data-range="false" name="check_in" id="check_in" placeholder="@lang('Month/Date/Year')" type="text" value="{{ old('check_in', $checkInDate ?? showDateTime(now(), 'Y-m-d')) }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="check_out" class="fw-bold">@lang('Check-Out')</label>
                                        <div class="custom-icon-field">
                                            <input autocomplete="off" class="check-out-date form--control" data-date-format="yyyy-mm-dd" data-language="en" data-position='top left' data-range="false" name="check_out" id="check_out" placeholder="@lang('Month/Date/Year')" type="text" value="{{ old('check_out', $checkOutDate ?? showDateTime(now()->addDays(), 'Y-m-d')) }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="bookingLimitationMsg text--warning"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="fw-bold" for="adult">@lang('Total Adult')</label>
                                        <div class="custom-icon-field">
                                            <input type="number" autocomplete="off" class="form--control" name="adult" id="adult" value="{{ old('adult', $searchData['adult'] ?? 1) }}">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="children" class="fw-bold">@lang('Total Child')</label>
                                        <div class="custom-icon-field">
                                            <input type="number" autocomplete="off" class="form--control" name="children" id="children" value="{{ old('children', $searchData['children'] ?? 0) }}">
                                            <i class="fa-solid fa-child"></i>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="number_of_rooms" class="fw-bold">@lang('Number of Rooms')</label>
                                        <div class="custom-icon-field">
                                            <input class="form--control" name="number_of_rooms" id="number_of_rooms" required type="number">
                                            <i class="fa-solid fa-list"></i>
                                        </div>
                                    </div>

                                    <div class="room-booking-widget__body">
                                        <button class="btn btn--base w-100" id="reserveBtn" type="submit">@lang('SELECT NOW')</button>
                                    </div>
                                </div><!-- room-booking-widget end -->
                            </div>
                        </div>
                    </form>

                    <div class="room-booking-sidebar mt-3">
                        @php
                            $contactContent = getContent('contact_us.content', true);
                        @endphp
                        <div class="content-item__top">
                            <h5 class="content-item__title"> @lang('Contact Information') </h5>
                            <p class="text">@lang('Have questions or want to make a reservation? Reach out to us anytime.')</p>
                        </div>
                        <ul class="info-list">
                            <li class="info-list__item">
                                <span class="info-list__title">
                                    @lang('Location')
                                </span>
                                <span class="info-list__text">
                                    <a href="https://www.google.com/maps?q={{ urlencode($contactContent?->data_values?->address) }}" target="_blank">{{ __($contactContent?->data_values?->address) }}</a>
                                </span>
                            </li>
                            <li class="info-list__item">
                                <span class="info-list__title">
                                    @lang('Mobile Number')
                                </span>
                                <span class="info-list__text">
                                    <a href="tel:{{ $contactContent?->data_values?->contact_number }}">{{ $contactContent?->data_values?->contact_number }}
                                    </a>
                                </span>
                            </li>
                            <li class="info-list__item">
                                <span class="info-list__title">
                                    @lang('Email Address')
                                </span>
                                <span class="info-list__text">
                                    <a href="mailto:{{ $contactContent?->data_values?->email_address }}">{{ $contactContent?->data_values?->email_address }}</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.en.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            let maxRoomBookingLimit;
            let btnRequest = $('#reserveBtn')

            var datepicker1 = $('.check-in-date').datepicker({
                autoClose: true
            });
            var datepicker2 = $('.check-out-date').datepicker({
                autoClose: true
            });

            getAvailableRooms();

            $('input[name=check_out],input[name=number_of_rooms]').on('change', function(e) {
                getAvailableRooms();
            });

            function getAvailableRooms() {
                let data = {};
                data.check_in = $('input[name=check_in]').val();
                data.check_out = $('input[name=check_out]').val();
                data.room_type_id = "{{ $roomType->id }}";

                if (!data.check_in || !data.check_out) {
                    return;
                }

                $.ajax({
                    type: "get",
                    url: "{{ route('room.available.search') }}",
                    data: data,
                    success: function(response) {
                        let messageBox = $('.bookingLimitationMsg');
                        if (response.success) {
                            maxRoomBookingLimit = response.success;
                            messageBox.text(`@lang('You can book maximum ${response.success} rooms')`);
                            btnRequest.removeAttr('disabled');
                        } else {
                            notify('error', response.error);
                            $('[name=number_of_rooms]').val('');
                            messageBox.empty();
                            btnRequest.attr('disabled', true);
                        }
                    }
                });
            }

            $('[name=number_of_rooms]').on('input', function() {
                btnRequest.attr('disabled', false);
                if ($(this).val() > maxRoomBookingLimit) {
                    btnRequest.attr('disabled', true);
                    notify('error', "Number of rooms can't be greater than maximum allowed room");
                }
            });

            $('.book-form').on('submit', function(e) {
                e.preventDefault();

                let roomTypeId = `{{ $roomType->id }}`;
                let numberOfRooms = $('[name=number_of_rooms]').val();
                let totalAdult = $('[name=adult]').val();
                let totalChildren = $('[name=children]').val();

                let checkIn = $('[name=check_in]').val();
                let checkout = $('[name=check_out]').val();

                const url = "{{ route('room.select') }}";
                let data = {
                    _token: `{{ csrf_token() }}`,
                    room_type_id: roomTypeId,
                    check_in: checkIn,
                    check_out: checkout,
                    number_of_rooms: numberOfRooms,
                    adult: totalAdult,
                    children: totalChildren
                };

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(response) {
                        if (response.status) {
                            notify('success', response.message);
                            let widget = $('.selection-widget');
                            widget.find('.amount').text(response.data.total_amount);
                            widget.find('.total_rooms').text(response.data.total_rooms);
                            widget.removeClass('widget-hide');
                        } else {
                            notify('error', response.errors);
                        }
                    }
                });
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .main-wrapper {
            background-color: #fafafa
        }
    </style>
@endpush
