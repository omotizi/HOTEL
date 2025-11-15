@extends('Template::layouts.frontend')
@section('content')
    @php
        $content = getContent('confirmation_page.content', true);
        $contactContent = getContent('contact_us.content', true);
    @endphp
    <div class="confirmation-section pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center gy-4">
                <div class="col-lg-8">
                    <div class="confirmation-container">

                        <div class="confirmation-container__wrapper">
                            <div class="confirmation-container__top">
                                <span class="confirmation-container__top-icon"> <i class="las la-check"></i> </span>
                                <div class="confirmation-container__top-content">
                                    <h2 class="confirmation-container__top-title">@lang('Congratulations')</h2>
                                    <h6 class="confirmation-container__top-text">@lang('Your booking request sent successfully')</h6>
                                </div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-info__item">
                                    <span class="contact-info__icon"> <i class="las la-map-marker"></i> </span>
                                    <p class="contact-info__text">{{ __($contactContent?->data_values?->address) }}</p>
                                </div>
                                <div class="contact-info__item">
                                    <span class="contact-info__icon"> <i class="las la-phone"></i> </span>
                                    <p class="contact-info__text"> <a href="tel:{{ $contactContent?->data_values?->contact_number }}" class="link">{{ $contactContent?->data_values?->contact_number }}</a> </p>
                                </div>
                                <div class="contact-info__item">
                                    <span class="contact-info__icon"> <i class="las la-map-marker"></i> </span>
                                    <p class="contact-info__text"> <a href="mailto:{{ $contactContent?->data_values?->email_address }}" class="link">{{ $contactContent?->data_values?->email_address }}</a> </p>
                                </div>
                            </div>
                            <div class="confirmation-container__body">
                                <div class="confirmation-container__content">
                                    <div class="confirmation-details">
                                        <h6 class="confirmation-details__title">@lang('Booking Details')</h6>
                                        <ul class="info-list">
                                            <li class="info-list__item">
                                                <span class="info-list__text">@lang('Check In')</span>
                                                <span class="info-list__text">{{ showDateTime($bookingRequest->check_in, 'F d, Y') }}</span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__text">@lang('Check Out')</span>
                                                <span class="info-list__text">{{ showDateTime($bookingRequest->check_out, 'F d, Y') }}</span>
                                            </li>

                                            <li class="info-list__item">
                                                <span class="info-list__text">@lang('Arrival')</span>
                                                <span class="info-list__text">{{ isset($bookingRequest->booking_info->arrival) ? showDateTime($bookingRequest->booking_info->arrival, 'H:i A') : '--' }}</span>
                                            </li>

                                            <li class="info-list__item">
                                                <span class="info-list__text">@lang('Arrival')</span>
                                                <span class="info-list__text">{{ isset($bookingRequest->booking_info->departure) ? showDateTime($bookingRequest->booking_info->departure, 'H:i A') : '--' }}</span>
                                            </li>

                                            <li class="info-list__item">
                                                <span class="info-list__text">@lang('Guests')</span>
                                                <span class="info-list__text">{{ $bookingRequest->total_adult . ' ' . str()->plural('adult', $bookingRequest->total_adult) }} @if($bookingRequest->total_child > 0) @lang('and') {{ $bookingRequest->total_child . ' ' . str()->plural('child', $bookingRequest->total_child) }}</span> @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="confirmation-details">
                                        <h6 class="confirmation-details__title">@lang('Booked By')</h6>
                                        <ul class="info-list">
                                            <li class="info-list__item">
                                                <span class="info-list__text">{{ __($bookingRequest->booking_info->name) }}</span>
                                                <span class="info-list__text"> @lang('Date:') {{ showDateTime($bookingRequest->created_at, 'F d, Y') }} </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__text"> {{ $bookingRequest->booking_info->email }} </span>
                                                <span class="info-list__text"> @lang('Status:') @if ($bookingRequest->status == Status::BOOKING_REQUEST_PENDING)
                                                        @lang('Pending')
                                                    @elseif($bookingRequest->status == Status::BOOKING_REQUEST_APPROVED)
                                                        @lang('Approved')
                                                    @endif </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__text"> +{{ $bookingRequest->booking_info->mobile }} </span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="confirmation-container__thumb">
                                    <img src="{{ frontendImage('confirmation_page', $content?->data_values?->image, '   ') }}" alt="">
                                    <h3 class="thumb-title"> {{ __($content?->data_values?->heading) }} </h3>
                                </div>
                            </div>
                        </div>
                        <div class="confirmation-container__bottom">
                            <h6 class="mb-0">{{ __($content?->data_values?->advise) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="addon-sidebar">
                        <div class="addon-sidebar__top">
                            <p class="title">@lang('Booking Summary')</p>
                            <p class="text"> {{ $bookingRequest->roomBookingRequest->count() }} @lang('Items selected')</p>
                        </div>
                        <p class="addon-sidebar__amount">
                            @lang('Total:') {{ showAmount($bookingRequest->totalFare()) }}
                        </p>
                        <p class="addon-sidebar__vat">@lang('Including taxes and fees')</p>
                        @foreach ($bookingRequest->roomBookingRequest as $item)
                            <div class="sidebar-item">
                                <ul class="amount-list">
                                    <li class="amount-list__item">
                                        <div>
                                            <p class="amount-list__title text--base"> {{ $item->roomType->name }}:</p>
                                            @if (isset($item->roomType->beds) && count($item->roomType->beds))
                                                @php
                                                    $beds = array_count_values($item->roomType->beds);
                                                @endphp
                                                <div class="d-flex justify-content-start align-items-center flex-wrap">
                                                    @foreach ($beds as $bed => $count)
                                                        <span class="amount-list__number">
                                                            {{ $count . ' ' . __($bed) . ' ' . __(str()->plural('bed', $count)) }}
                                                        </span>
                                                        @if (!$loop->last)
                                                            ,&nbsp;
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if ($item->roomType->room_suite == Status::SUITE)
                                                @foreach ($item->roomType->suitesTypeRooms->groupBy('room_type') as $key => $suiteTypeRoom)
                                                    <span class="amount-list__number">{{ __(keyToTitle($key)) }}({{ $suiteTypeRoom->count() }})</span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span class="amount-list__price"> {{ showAmount($item->unit_fare) }}
                                        </span>
                                    </li>
                                    <li class="amount-list__item">
                                        <div>
                                            <p class="amount-list__title"> @lang('Number of Room :') {{ $item->quantity }}
                                            </p>
                                            <p class="amount-list__number">
                                                <span class="time">
                                                    {{ daysDifference($item->check_in, $item->check_out) }} @lang('Night Stay') </span>
                                            </p>
                                        </div>
                                        <span class="amount-list__price">
                                            {{ showAmount($item->total_fare) }}
                                        </span>
                                    </li>
                                    <li class="amount-list__item btn-wrapper">
                                        <div>
                                            <p class="amount-list__title">
                                                <span class="icon"> <i class="las la-user"></i></span>
                                                {{ $item->adult . ' ' . __(str()->plural('Adult', $item->adult)) }}@if ($item->children > 0)
                                                    , {{ $item->children . ' ' . __(str()->plural('Child', $item->children)) }}
                                                @endif
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                        <div class="sidebar-item">
                            <ul class="amount-list">
                                <li class="amount-list__item">
                                    <div>
                                        <p class="amount-list__title">@lang('Tax')</p>
                                        <span class="amount-list__number">{{ __(gs('tax_name')) }}({{ showAmount($bookingRequest->taxPercentage(), currencyFormat:false) }}%)</span>
                                    </div>
                                    <span class="amount-list__price"> {{ showAmount($bookingRequest->tax_charge) }} </span>
                                </li>
                            </ul>
                        </div>
                        <div class="addon-sidebar__bottom">
                            <div class="addon-sidebar__total">
                                <div>
                                    <p class="addon-sidebar__amount">
                                        @lang('Total:')
                                    </p>
                                    <p class="addon-sidebar__vat">@lang('Including taxes and fees')</p>
                                </div>
                                <p class="addon-sidebar__total-amount">{{ showAmount($bookingRequest->totalFare()) }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
