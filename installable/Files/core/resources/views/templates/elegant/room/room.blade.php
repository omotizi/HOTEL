@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include('Template::partials.search_banner')
    <!--==================== category section start here ==================== -->
    <div class="category-section">
        <div class="category-section__shape">
            <img src="{{ asset(activeTemplate(true) . 'images/shapes/ca-1.png') }}" alt="image">
        </div>
        <div class="container">
            <div class="category-wrapper">
                <div class="category-wrapper__left">
                    <p class="title"> @lang('Filter by') </p>
                    <ul class="link-list">
                        <li><a href="{{ appendQuery('type', null) }}" class="{{ request('type') == '' ? 'active' : '' }}">@lang('All')</a></li>
                        <li><a href="{{ appendQuery('type', 'room') }}" class="{{ request('type') == 'room' ? 'active' : '' }}">@lang('Rooms')</a></li>
                        <li><a href="{{ appendQuery('type', 'suite') }}" class="{{ request('type') == 'suite' ? 'active' : '' }}">@lang('Suites')</a></li>
                    </ul>
                </div>
                <div class="category-wrapper__right">
                    <p class="title"> @lang('Select up to 3 rooms to compare') </p>
                    <div class="room-category">
                        <div class="room-compare"></div>
                        <a href="{{ route('compare') }}" class="btn-outline--base btn btn--lg" id="compare_btn"> @lang('Compare') </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==================== category section end here ==================== -->

    <!-- room category  section start here  -->
    <section class="room-category-section room-section mt-60 mb-120">
        <div class="container">
            <div class="row gy-5">
                @php
                    $checkin = session('search_data')['check_in'];
                    $checkout = session('search_data')['check_out'];
                @endphp
                @foreach ($roomTypes as $roomType)
                    @php
                        $availableRooms = countAvailableRooms($roomType, $checkin, $checkout);
                    @endphp
                    <div class="col-lg-6">
                        <div class="room-category-wrapper">
                            <div class="room-category-slider category-slider">
                                <div class="room-category-slider__item">
                                    <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . $roomType->main_image, getFileSize('roomTypeImage')) }}" alt="room">
                                </div>
                                @foreach ($roomType->images as $roomImage)
                                    <div class="room-category-slider__item">
                                        <img src="{{ getImage(getFilePath('roomTypeImage') . '/' . @$roomImage->image, getFileSize('roomTypeImage')) }}" alt="room">
                                    </div>
                                @endforeach
                            </div>
                            <div class="room-category-content">
                                <div class="room-category-top">
                                    <div class="left">
                                        <h5 class="room-category-content__title">
                                            <a href="{{ route('room.type.details', $roomType->slug) }}" class="detailBtn" data-id="{{ $roomType->id }}">{{ __($roomType->name) }}</a>
                                        </h5>
                                        <p class="room-space">@lang('Capacity:') {{ $roomType->total_adult }} @lang('Adults'), {{ $roomType->total_child }} @lang('Children')</p>
                                        <p class="room-space">@lang('Size:') {{ __(@$roomType->size) }}</p>
                                        <p class="room-space">@lang('Available Rooms:') {{ $availableRooms }}</p>
                                    </div>
                                    <p class="room-desc">
                                        @if ($roomType->checkOffer())
                                            <span class="old-price">
                                                <del class="pe-1">{{ showAmount($roomType->fare) }}</del>
                                            </span>
                                            <span class="fw-bold"><span class="fare">{{ showAmount($roomType->roomFare()) }}</span> /@lang('night')</span>
                                        @else
                                            <span><span class="fare">{{ showAmount($roomType->fare) }}</span> /@lang('night')</span>
                                        @endif
                                        <span>
                                    </p>
                                </div>
                                <div class="mt-4 room-card__bottom">
                                    <label class="form--label"> @lang('Number of Rooms')</label>
                                    <div class="d-flex flex-wrap justify-content-start gap-4 input-wrapper">
                                        <div class="qty-wrapper">
                                            <button class="decrement-btn btn-light disabled" type="button"><i class="fa fa-minus"></i></button>
                                            <input type="text" name="number_of_rooms[]" value="1" class="input-qty numberOfRoom" readonly/>
                                            <button class="increment-btn btn-light @if ($availableRooms == 1) disabled @endif" data-max="{{ $availableRooms }}" type="button"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <button type="button" class="btn btn--base addBtn" data-room_type_id="{{ $roomType->id }}">@lang('Book')</button>
                                    </div>
                                </div>
                                <div class="form--check mt-3">
                                    <input class="form-check-input compare-checkbox" type="checkbox" value="{{ $roomType->id }}" id="room_{{ $roomType->id }}" @checked(in_array($roomType->id, $compares))>
                                    <label class="form-check-label" for="room_{{ $roomType->id }}">
                                        @lang('Add to compare')
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- room category  section end here  -->

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.increment-btn').on('click', function() {
                let max = $(this).data('max');
                let inputField = $(this).parents('.room-card__bottom').find('.numberOfRoom');
                let value = Number(inputField.val()) + 1;

                if (value <= max) {
                    inputField.val(value);
                    $(this).parents('.room-card__bottom').find('.decrement-btn').removeClass('disabled');
                    if (value == max) $(this).addClass('disabled');
                }
            });

            $('.decrement-btn').on('click', function() {
                let inputField = $(this).parents('.room-card__bottom').find('.numberOfRoom');
                let value = Number(inputField.val()) - 1;

                if (value >= 1) {
                    inputField.val(value);
                    $(this).parents('.room-card__bottom').find('.increment-btn').removeClass('disabled');
                    if (value == 1) $(this).addClass('disabled');
                }
            });

            $('.compare-checkbox').on('change', function() {
                let roomId = $(this).val();
                getCompare(roomId);
            });

            function getCompare(id) {
                let roomId = id;
                $.ajax({
                    url: "{{ route('compare') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: roomId,
                    },
                    success: function(response) {
                        if (response.message == "success") {
                            if (response.compare_count) {
                                $('#compare_btn').removeClass('disabled');
                            } else {
                                $('#compare_btn').addClass('disabled');
                            }
                            $('.room-compare').html(`${response.view}`)
                        } else {
                            let checkId = '#room_' + roomId;
                            $(checkId).prop('checked', false);
                            notify('error', response.notify);
                        }
                    }
                })
            }

            getCompare(null);

            $(document).on('click', '.removeFromCompareBtn', function() {
                let self = $(this);
                let id = self.data('id');
                $.ajax({
                    url: "{{ route('compare') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        if (response.message == "success") {
                            self.closest('.short-compare').remove();
                            $(`.compare-checkbox[value="${id}"]`).prop('checked', false);
                            if ($('.room-compare').find('.short-compare').length == 0) {
                                $('#compare_btn').addClass('disabled');
                            }
                        } else {
                            notify('error', response.notify);
                        }
                    }
                })
            });

            $('.addBtn').on('click', function() {
                let roomTypeId = $(this).data('room_type_id');
                let numberOfRooms = $(this).parents('.input-wrapper').find('.numberOfRoom').val();
                let totalAdult = $('.qty-container').find('[name=adult]').val();
                let totalChildren = $('.qty-container').find('[name=children]').val();


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
        .link-list {
            display: flex;
            align-items: center;
            gap: 10px 15px;
            flex-wrap: wrap;
        }

        .link-list li a {
            color: hsl(var(--base));
            font-style: italic;
            position: relative;
        }

        .link-list li a::after {
            position: absolute;
            content: "";
            bottom: -4px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            width: 0;
            height: 1px;
            background-color: hsl(var(--base));
            -webkit-transition: 0.2s linear;
            transition: 0.2s linear;
        }

        .link-list li a:hover::after,
        .link-list li a.active::after {
            width: 100%;
        }
    </style>
@endpush
