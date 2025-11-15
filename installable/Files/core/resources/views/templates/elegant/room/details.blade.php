@php
    $contactContent = getContent('contact_us.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend', ['banner' => false])
@section('content')
    @include($activeTemplate . 'partials.banner', ['type' => 'room_detail','size','1920x570'])
    <div class="room-details mt-60">
        <div class="container">
            <div class="room-details__top">
                <h3 class="room-details__title"> {{ __(@$roomType->name) }} </h3>
                <div class="room-details__desc">
                    @php echo strLimit(strip_tags($roomType->description), 100)  @endphp </div>
            </div>
            <div class="room-details-body">
                <div class="row gy-4">
                    <div class="col-lg-7">
                        <div class="room-details-body__left">
                            <div class="room-details__wrapper">
                                <div class="room-details__item">
                                    <img src="{{ getImage(getFilePath('roomTypeImage') . '/' . $roomType->main_image, getFileSize('roomTypeImage')) }}" alt="room">
                                </div>
                                @foreach ($roomType->images as $roomImage)
                                    <div class="room-details__item">
                                        <img src="{{ getImage(getFilePath('roomTypeImage') . '/' . @$roomImage->image, getFileSize('roomTypeImage')) }}" alt="room">
                                    </div>
                                @endforeach
                            </div>
                            @if ($roomType->images->count())
                            <div class="room-details__gallery">
                                <div class="room-gallery__item">
                                    <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$roomType->main_image, getFileSize('roomTypeImage')) }}" alt="room">
                                </div>
                                @foreach ($roomType->images as $roomImage)
                                    <div class="room-gallery__item">
                                        <img src="{{ getImage(getFilePath('roomTypeImage') . '/' . @$roomImage->image, getFileSize('roomTypeImage')) }}" alt="room">
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <!-- room details content  -->
                            <div class="room-details-content @if(!$roomType->images->count()) mt-0 @endif">
                                <div class="content-item">
                                    <div class="content-item__top">
                                        <h5 class="content-item__title"> @lang('Description') </h5>
                                        <p class="text"> @lang('Overview of ') {{ __($roomType->name) }} </p>
                                    </div>
                                    <div class="content-item__desc">
                                        @php echo $roomType->description @endphp
                                    </div>
                                    <ul class="info-list">
                                        <li class="info-list__item">
                                            <span class="info-list__title">@lang('Room Size')</span>
                                            <span class="info-list__text">{{ __($roomType->size) }}</span>
                                        </li>
                                        @if (isset($roomType->beds) && !empty($roomType->beds))
                                            @php
                                                $beds = array_count_values($roomType->beds);
                                            @endphp
                                            <li class="info-list__item">
                                                <span class="info-list__title">@lang('Bed')</span>
                                                <span class="info-list__text">
                                                    @foreach ($beds as $bed => $count)
                                                        {{ $count. ' ' . __($bed). ' '. __(str()->plural('bed', $count)) }}
                                                        @if (!$loop->last),&nbsp; @endif
                                                    @endforeach
                                                </span>
                                            </li>
                                        @endif

                                        <li class="info-list__item">
                                            <span class="info-list__title">@lang('Capacity')</span>
                                            <span class="info-list__text">
                                                {{ $roomType->total_adult. ' '. str()->plural('adult', $roomType->total_adult) }}
                                                @if($roomType->total_child)
                                                   @lang('and') {{ $roomType->total_child. ' '. str()->plural('child', $roomType->total_child) }}
                                                @endif
                                            </span>
                                        </li>

                                        @if ($roomType->cancellation_fee > 0)
                                            <li class="info-list__item">
                                                <span class="info-list__title">@lang('Cancellation Fee')</span>
                                                <span class="info-list__text">{{ showAmount($roomType->cancellation_fee) }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                @if ($roomType->amenities->count() || $roomType->facilities->count())
                                    <div class="content-item">
                                        <div class="content-item__top">
                                            <h5 class="content-item__title"> @lang('Services and Benefits') </h5>
                                            <p class="text"> @lang('Some services & benefits of ') {{ __($roomType->name) }} </p>
                                        </div>
                                        <div class="rooms-service-wrapper">
                                            @if ($roomType->amenities->count())
                                                <div class="rooms-service">
                                                    <p class="rooms-service__title"> @lang('Amenities :') </p>
                                                    <ul class="service-list">
                                                        @foreach ($roomType->amenities as $amenity)
                                                            <li class="service-list__item">
                                                                <span class="image">
                                                                    <img src="{{ getImage(getFilePath('amenity'). '/'. $amenity->image, getFileSize('amenity')) }}" alt="">
                                                                </span>
                                                                <span class="name">{{ __($amenity->title) }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if ($roomType->facilities->count())
                                                <div class="rooms-service">
                                                    <p class="rooms-service__title"> @lang('Facilities :') </p>
                                                    <ul class="service-list">
                                                        @foreach ($roomType->facilities as $facility)
                                                            <li class="service-list__item">
                                                                <span class="image">
                                                                    <img src="{{ getImage(getFilePath('facility'). '/'. $facility->image, getFileSize('facility')) }}" alt="">
                                                                </span>
                                                                <span class="name">{{ __($facility->title) }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (@$roomType->room_suite == Status::SUITE)
                                    <div class="content-item">
                                        <div class="content-item__top">
                                            <h5 class="content-item__title"> @lang('Suite Rooms') </h5>
                                            <p class="text"> @lang('Overview of suite rooms of') {{ __($roomType->name) }}</p>
                                        </div>
                                        <div class="rooms-service-wrapper">
                                            @foreach ($roomType->suitesTypeRooms as $suiteTypeRoom)
                                                <div class="rooms-service">
                                                    <p class="rooms-service__title"> {{ __(keyToTitle($suiteTypeRoom->room_type)) }}
                                                    </p>
                                                    <ul class="service-list">
                                                        @foreach ($suiteTypeRoom->items as $item)
                                                            <li class="service-list__item"> {{ __($item) }} </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (strip_tags($roomType->cancellation_policy))
                                    <div class="content-item">
                                        <div class="content-item__top">
                                            <h5 class="content-item__title"> @lang('Cancellation Policy') </h5>
                                            <p class="text">@lang('Cancellation policy of') {{ __($roomType->name) }}</p>
                                        </div>
                                        <div class="content-item__desc">
                                            @php echo $roomType->cancellation_policy @endphp
                                        </div>
                                    </div>
                                @endif

                                <div class="content-item">
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
                    <div class="col-lg-5">
                        <div class="room-details-body__right">
                            <div class="booking-card">
                                <div class="booking-card__top">
                                    <h6 class="booking-card__title"> @lang('Book Now')</h6>
                                    <p class="booking-card__price">
                                        @if ($roomType->checkOffer())
                                            <del class="me-2 text--danger">{{ gs('cur_sym'). showAmount($roomType->fare, currencyFormat:false) }}</del>
                                            <b>{{ showAmount($roomType->roomFare()) }}</b>
                                        @else
                                            <b>{{ showAmount($roomType->fare) }}</b>
                                        @endif /@lang('night')
                                    </p>
                                </div>
                                <div class="booking-card__body">
                                    <form class="filter-form" method="post">
                                        @csrf
                                        <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
                                        <div class="check-in-out">
                                            <div class="filter-form__item">
                                                <div class="datepicker-inner">
                                                    <label class="form--label"> @lang('Check In') </label>
                                                    <input type="text" placeholder="Enter date" name="check_in" value="{{ old('check_in', $checkInDate ?? showDateTime(now(), 'Y-m-d')) }}" class="form--control datepicker2 flatpickr-input active" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="filter-form__item">
                                                <div class="datepicker-inner">
                                                    <label class="form--label"> @lang('Check Out') </label>
                                                    <input type="text" placeholder="Enter date" name="check_out" value="{{ old('check_out', $checkOutDate ?? showDateTime(now()->addDays(), 'Y-m-d')) }}" class="form--control datepicker2 flatpickr-input active" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="filter-form__item">
                                            <div class="form-qty-item">
                                                <div class="icon-text">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-user-group"></i>
                                                    </span>
                                                    <span class="text"> @lang('Guests') </span>
                                                </div>
                                                <button type="button" class="total-number"> <span class="adult_count">{{ old('adult', $searchData['adult'] ?? 1) }}</span>
                                                    @lang('adults'), <span class="children_count">{{ old('children', $searchData['children'] ?? 0) }}</span>
                                                    @lang('children') </button>
                                                <div class="number-picker">
                                                    <ul class="passenger-list">
                                                        <li class="passenger-list__item">
                                                            <div class="passenger-list__item-left">
                                                                @lang('Adults') <span class="passenger-list__text">
                                                                    @lang('12 years and above') </span>
                                                            </div>
                                                            <div class="qty-container">
                                                                <button class="qty-btn-minus btn-light" data-count_for="adult_count" type="button"><i class="fa fa-minus"></i></button>
                                                                <input type="number" name="adult" value="{{ old('adult', $searchData['adult'] ?? 1) }}" class="input-qty" />
                                                                <button class="qty-btn-plus btn-light" data-count_for="adult_count" type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </li>
                                                        <li class="passenger-list__item">
                                                            <div class="passenger-list__item-left">
                                                                @lang('Children') <span class="passenger-list__text">
                                                                    @lang('2 - 12 years') </span>
                                                            </div>
                                                            <div class="qty-container">
                                                                <button class="qty-btn-minus btn-light" data-count_for="children_count" type="button"><i class="fa fa-minus"></i></button>
                                                                <input type="number" name="children" value="{{ old('children', $searchData['children'] ?? 0) }}" class="input-qty" />
                                                                <button class="qty-btn-plus btn-light" data-count_for="children_count" type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="filter-form__item">
                                            <div class="datepicker-inner">
                                                <label class="form--label"> @lang('Number Of ') {{ ucfirst(__($roomType->getRoomOrSuite())) }} </label>
                                                <input type="text" name="number_of_rooms" value="{{ old('number_of_rooms', 1) }}" class="form--control datepicker3 ">
                                            </div>
                                            <div class="availableRoomCount"></div>
                                        </div>

                                        <div class="filter-form__item">
                                            <button type="submit" class="btn--base btn" id="reserveBtn" disabled>
                                                @lang('Select Now')
                                            </button>
                                        </div>
                                    </form>
                                    <div class="booking-card__bottom">
                                        <span class="icon">
                                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.2" d="M22.25 12C22.25 13.1719 20.5813 14.0625 20.1219 15.1594C19.6625 16.2562 20.2531 18.0281 19.3906 18.8906C18.5281 19.7531 16.7188 19.1812 15.6594 19.6219C14.6 20.0625 13.6719 21.75 12.5 21.75C11.3281 21.75 10.4375 20.0813 9.34063 19.6219C8.24375 19.1625 6.47187 19.7531 5.60938 18.8906C4.74688 18.0281 5.31875 16.2188 4.87813 15.1594C4.4375 14.1 2.75 13.1719 2.75 12C2.75 10.8281 4.41875 9.9375 4.87813 8.84063C5.3375 7.74375 4.74688 5.97187 5.60938 5.10938C6.47187 4.24688 8.28125 4.81875 9.34063 4.37813C10.4 3.9375 11.3281 2.25 12.5 2.25C13.6719 2.25 14.5625 3.91875 15.6594 4.37813C16.7562 4.8375 18.5281 4.24688 19.3906 5.10938C20.2531 5.97187 19.6812 7.78125 20.1219 8.84063C20.5625 9.9 22.25 10.8281 22.25 12Z" fill="currentColor" />
                                                <path d="M21.6781 9.6375C21.3219 9.27188 20.9562 8.8875 20.8156 8.55938C20.675 8.23125 20.6844 7.74375 20.675 7.24688C20.6656 6.3375 20.6469 5.29688 19.925 4.575C19.2031 3.85312 18.1625 3.83437 17.2531 3.825C16.7562 3.81562 16.25 3.80625 15.9406 3.68437C15.6312 3.5625 15.2281 3.17813 14.8625 2.82188C14.2156 2.20313 13.475 1.5 12.5 1.5C11.525 1.5 10.7844 2.20313 10.1375 2.82188C9.77188 3.17813 9.3875 3.54375 9.05938 3.68437C8.73125 3.825 8.24375 3.81562 7.74688 3.825C6.8375 3.83437 5.79688 3.85312 5.075 4.575C4.35312 5.29688 4.33437 6.3375 4.325 7.24688C4.31562 7.74375 4.30625 8.25 4.18437 8.55938C4.0625 8.86875 3.67813 9.27188 3.32188 9.6375C2.70313 10.2844 2 11.025 2 12C2 12.975 2.70313 13.7156 3.32188 14.3625C3.67813 14.7281 4.04375 15.1125 4.18437 15.4406C4.325 15.7687 4.31562 16.2562 4.325 16.7531C4.33437 17.6625 4.35312 18.7031 5.075 19.425C5.79688 20.1469 6.8375 20.1656 7.74688 20.175C8.24375 20.1844 8.75 20.1938 9.05938 20.3156C9.36875 20.4375 9.77188 20.8219 10.1375 21.1781C10.7844 21.7969 11.525 22.5 12.5 22.5C13.475 22.5 14.2156 21.7969 14.8625 21.1781C15.2281 20.8219 15.6125 20.4562 15.9406 20.3156C16.2687 20.175 16.7562 20.1844 17.2531 20.175C18.1625 20.1656 19.2031 20.1469 19.925 19.425C20.6469 18.7031 20.6656 17.6625 20.675 16.7531C20.6844 16.2562 20.6938 15.75 20.8156 15.4406C20.9375 15.1312 21.3219 14.7281 21.6781 14.3625C22.2969 13.7156 23 12.975 23 12C23 11.025 22.2969 10.2844 21.6781 9.6375ZM20.5906 13.3219C20.1406 13.7906 19.6812 14.2781 19.4281 14.8688C19.175 15.4594 19.1844 16.0969 19.175 16.725C19.1656 17.3531 19.1562 18.075 18.8656 18.3656C18.575 18.6562 17.8906 18.6656 17.225 18.675C16.5594 18.6844 15.9406 18.6937 15.3688 18.9281C14.7969 19.1625 14.2906 19.6406 13.8219 20.0906C13.3531 20.5406 12.875 21 12.5 21C12.125 21 11.6469 20.5406 11.1781 20.0906C10.7094 19.6406 10.2219 19.1812 9.63125 18.9281C9.04063 18.675 8.40312 18.6844 7.775 18.675C7.14687 18.6656 6.425 18.6562 6.13437 18.3656C5.84375 18.075 5.83437 17.3906 5.825 16.725C5.81562 16.0594 5.80625 15.4406 5.57187 14.8688C5.3375 14.2969 4.85938 13.7906 4.40938 13.3219C3.95938 12.8531 3.5 12.375 3.5 12C3.5 11.625 3.95938 11.1469 4.40938 10.6781C4.85938 10.2094 5.31875 9.72188 5.57187 9.13125C5.825 8.54063 5.81562 7.90312 5.825 7.275C5.83437 6.64687 5.84375 5.925 6.13437 5.63437C6.425 5.34375 7.10938 5.33437 7.775 5.325C8.44062 5.31562 9.05938 5.30625 9.63125 5.07187C10.2031 4.8375 10.7094 4.35938 11.1781 3.90938C11.6469 3.45938 12.125 3 12.5 3C12.875 3 13.3531 3.45938 13.8219 3.90938C14.2906 4.35938 14.7781 4.81875 15.3688 5.07187C15.9594 5.325 16.5969 5.31562 17.225 5.325C17.8531 5.33437 18.575 5.34375 18.8656 5.63437C19.1562 5.925 19.1656 6.60938 19.175 7.275C19.1844 7.94062 19.1937 8.55938 19.4281 9.13125C19.6625 9.70312 20.1406 10.2094 20.5906 10.6781C21.0406 11.1469 21.5 11.625 21.5 12C21.5 12.375 21.0406 12.8531 20.5906 13.3219ZM17.1688 9.23438C17.3053 9.37867 17.3791 9.57126 17.3738 9.76988C17.3686 9.9685 17.2847 10.1569 17.1406 10.2938L11.6469 15.5438C11.5048 15.6774 11.3169 15.7512 11.1219 15.75C10.9298 15.7507 10.7449 15.6768 10.6063 15.5438L7.85938 12.9188C7.78319 12.8523 7.72123 12.7711 7.67722 12.6801C7.6332 12.589 7.60805 12.49 7.60328 12.389C7.5985 12.2881 7.61419 12.1871 7.64941 12.0924C7.68463 11.9976 7.73865 11.9109 7.80822 11.8375C7.87779 11.7642 7.96148 11.7056 8.05426 11.6654C8.14703 11.6252 8.24697 11.6042 8.34808 11.6036C8.44919 11.603 8.54937 11.6229 8.64261 11.662C8.73584 11.7011 8.82021 11.7587 8.89062 11.8312L11.1219 13.9594L16.1094 9.20625C16.2537 9.06966 16.4463 8.9959 16.6449 9.00117C16.8435 9.00645 17.0319 9.09032 17.1688 9.23438Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span class="text"> @lang('BEST RATE GUARANTEE') </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!blank($moreRoomTypes))
        <section class="offer-section style-two  mb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-top">
                            <div class="section-heading style-left">
                                <h3 class="section-heading__title"> @lang('More') {{ __($roomType->getRoomOrSuite(true)) }} </h3>
                                <p class="section-heading__desc"> @lang('Because you deserve the best, especially when you stay with us.') </p>
                            </div>
                            <a href="{{ route('rooms') }}?type={{ $roomType->getRoomOrSuite() }}" class="btn btn--base"> @lang('View all') <span class="icon"> <i class="las la-arrow-right"></i> </span> </a>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 justify-content-center">
                    @foreach ($moreRoomTypes as $roomType)
                        <div class="col-lg-4 col-md-6">
                            <div class="offer-card">
                                <div class="offer-card__slider category-slider">
                                    <div class="offer-card__slider-item">
                                        <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$roomType->main_image, getFileSize('roomTypeImage')) }}" alt="img">
                                    </div>
                                    @foreach ($roomType->images as $roomImage)
                                        <div class="offer-card__slider-item">
                                            <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$roomImage->image, getFileSize('roomTypeImage')) }}" alt="img">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="offer-card__content">
                                    <h5 class="offer-card__title">
                                        <a href="{{ route('room.type.details', $roomType->slug) }}">
                                            {{ __($roomType->name) }}
                                        </a>
                                    </h5>
                                    <p class="offer-card__desc">
                                        @php echo strLimit(strip_tags($roomType->description), 100)  @endphp
                                    </p>
                                    <a href="{{ route('room.type.details', $roomType->slug) }}" class="view-more-btn"> @lang('View Room')
                                        <span class="icon">
                                            <i class="las la-arrow-right"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection



@push('style')
    <style>
        .datepicker-inner:has(input[name=number_of_rooms])::after {
            content: '\f594';
        }
        .form--control[readonly] {
            background-color: transparent !important;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            let adultMax = `{{ $roomType->total_adult }}`;
            let childMax = `{{ $roomType->total_child }}`;

            $('.qty-btn-plus').on('click', function() {
                let countFor = $(this).data('count_for');
                let inputVal = $(this).parent(".qty-container").find(".input-qty");

                if (countFor == 'adult_count' && inputVal.val() >= adultMax) {
                    return false;
                }

                if (countFor == 'children_count' && inputVal.val() >= childMax) {
                    return false;
                }

                let currentValue = Number(inputVal.val()) + 1;
                inputVal.val(currentValue);
                let incrementClassName = '.' + countFor;
                $(this).closest('.form-qty-item').find(incrementClassName).text(currentValue)
            });

            $('.qty-btn-minus').on('click', function() {
                let countFor = $(this).data('count_for');
                let inputVal = $(this).parent(".qty-container").find(".input-qty");
                if (countFor == 'adult_count' && inputVal.val() <= 1) {
                    return false;
                }
                let currentValue = Number(inputVal.val()) - 1;
                if (currentValue >= 0) {
                    inputVal.val(currentValue);
                    let incrementClassName = '.' + countFor;
                    $(this).closest('.form-qty-item').find(incrementClassName).text(currentValue)
                }
            });

            let checkIn = $('input[name=check_in]').val();
            let checkOut = $('input[name=check_out]').val();

            if (checkIn && checkOut) {
                getAvailableRooms(checkIn, checkOut);
            }

            $('input[name=check_out],input[name=number_of_rooms]').on('change', function(e) {
                e.preventDefault();

                let check_in = $('input[name=check_in]').val();
                let check_out = $('input[name=check_out]').val();

                getAvailableRooms(check_in, check_out);
            });


            function getAvailableRooms(checkIn, checkout) {
                let roomTypeId = `{{ @$roomType->id }}`;
                let roomType = `{{ @$roomType->getRoomOrSuite() }}`;
                if (!checkIn || !checkout) {
                    return false;
                }

                $.ajax({
                    type: "get",
                    url: `{{ route('room.available.search') }}`,
                    data: {
                        "check_in": checkIn,
                        "check_out": checkout,
                        "room_type_id": roomTypeId,
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.availableRoomCount').html(`
                                <p class="my-2 text--base"><i class="las la-info-circle"></i> We have ${response.success} ${roomType}s available for booking</p>
                            `)

                            let inputNumberRoom = $('input[name=number_of_rooms]').val();

                            if (response.success < inputNumberRoom) {
                                $('#reserveBtn').attr('disabled', true);
                            } else {
                                $('#reserveBtn').removeAttr('disabled');
                            }

                        } else {
                            notify('error', response.error);
                            $('.availableRoomCount').html(``)
                            $('#reserveBtn').attr('disabled', true);
                        }
                    }
                });
            }

            $('.filter-form').on('submit', function(e){
                e.preventDefault();
                let roomTypeId = `{{ $roomType->id }}`;
                let numberOfRooms = $('[name=number_of_rooms]').val();
                let totalAdult = $('.qty-container').find('[name=adult]').val();
                let totalChildren = $('.qty-container').find('[name=children]').val();

                let checkIn = $('[name=check_in]').val();
                let checkout = $('[name=check_out]').val();

                const url = "{{ route('room.select') }}";
                let data ={
                    _token:`{{ csrf_token() }}`,
                    room_type_id: roomTypeId,
                    check_in:checkIn,
                    check_out:checkout,
                    number_of_rooms:numberOfRooms,
                    adult:totalAdult,
                    children:totalChildren
                };

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (response) {
                        if(response.status){
                            notify('success', response.message);
                            let widget = $('.selection-widget');
                            widget.find('.amount').text(response.data.total_amount);
                            widget.find('.total_rooms').text(response.data.total_rooms);
                            widget.removeClass('widget-hide');
                        }else{
                            notify('error', response.errors);
                        }
                    }
                });
            });

        })(jQuery);
    </script>
@endpush
