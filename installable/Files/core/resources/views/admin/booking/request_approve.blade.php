@extends('admin.layouts.app')
@section('panel')
    <div class="row gy-4 booking-wrapper">
        <div class="col-xxl-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('Booking Information')</h5>
                </div>

                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 justify-content-between mb-1">
                        <div class="d-flex flex-column mb-3">
                            <h6>{{ @$bookingRequest->booking_info->name }}</h6>
                            <small class="text-muted">@lang('Guest Name')</small>
                        </div>

                        <div class="d-flex flex-column mb-3">
                            <h6>+{{ @$bookingRequest->booking_info->dial_code }}{{ @$bookingRequest->booking_info->mobile }}</h6>
                            <small class="text-muted">@lang('Mobile')</small>
                        </div>

                        <div class="d-flex flex-column">
                            <h6>{{ @$bookingRequest->booking_info->email }}</h6>
                            <small class="text-muted">@lang('Email')</small>
                        </div>
                        @if (isset($bookingRequest->booking_info->arrival))
                            <div class="d-flex flex-column">
                                <h6>{{ showDateTime($bookingRequest->booking_info->arrival, 'h:iA') }}</h6>
                                <small class="text-muted">@lang('Arrival')</small>
                            </div>
                        @endif

                        @if (isset($bookingRequest->booking_info->departure))
                            <div class="d-flex flex-column">
                                <h6>{{ showDateTime($bookingRequest->booking_info->departure, 'h:iA') }}</h6>
                                <small class="text-muted">@lang('Departure')</small>
                            </div>
                        @endif
                    </div>

                    @if (@$bookingRequest->booking_info->special_request)
                        <div class="special-request">
                            <h6 class="text--info">@lang('Special Request')</h6>
                            <small class="text-muted">{{ @$bookingRequest->booking_info->special_request }}</small>
                        </div>
                    @endif

                    @if (!blank(@$bookingRequest->guests))
                        <div class="mt-3 d-flex gap-5 flex-wrap">
                            <div>
                                <h6>@lang('Another guests'):</h6>
                                <ul class="guest-list">
                                    @foreach ($bookingRequest->guests ?? [] as $guest)
                                        <li>{{ @$guest->guest_first_name }} {{ @$guest->guest_last_name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="bookingInfo row gy-4 mt-0"></div>
        </div>
        <div class="col-xxl-4 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">
                        <h5>@lang('Book Room')</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.request.booking.assign.room') }}" class="booking-form formRoomSearch" method="POST" data-tax-charge="{{ gs('tax') }}" data-coupon-amount="{{ $bookingRequest->coupon_amount }}">
                        @csrf
                        <input name="booking_request_id" type="hidden" value="{{ $bookingRequest->id }}">
                        <div class="orderList d-none">
                            <ul class="list-group list-group-flush orderItem">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <h6>@lang('Room')</h6>
                                    <h6>@lang('Days')</h6>
                                    <h6>@lang('Fare')</h6>
                                    <h6>@lang('Total')</h6>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center border-top p-2 px-3">
                                <span>@lang('Subtotal')</span>
                                <span class="totalFare" data-amount="0"></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top p-2 px-3">
                                <span>{{ gs('tax_name') }} <small>({{ getAmount($bookingRequest->taxPercentage()) }}%)</small></span>
                                <span>
                                    <span class="taxCharge">{{ showAmount($bookingRequest->tax_charge, currencyFormat: false) }}
                                    </span> {{ gs()->cur_text }}</span>
                                <input name="tax_charge" type="hidden">
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top p-2 px-3">
                                <span>@lang('Coupon Discount')</span>
                                <span class="couponAmount" data-coupon_amount="{{ $bookingRequest->coupon_amount }}">{{ showAmount($bookingRequest->coupon_amount, currencyFormat: false) }} {{ gs('cur_text') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-top p-2 px-3">
                                <span>@lang('Total Fare')</span>
                                <span class="grandTotalFare"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Paying Amount')</label>
                            <div class="input-group">
                                <input class="form-control" min="0" name="paid_amount" step="any" type="number">
                                <span class="input-group-text">{{ __(gs()->cur_text) }}</span>
                            </div>
                        </div>
                        @can(['admin.request.booking.assign.room'])
                            <button class="btn btn--primary w-100 h-45 btn-book confirmBookingBtn" type="button" disabled>@lang('Book Now')</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmBookingModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation Alert!')</h5>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure to book this rooms?')</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                    <button class="btn btn--primary btn-confirm" type="button">@lang('Yes')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.request.booking.all') }}" />
@endpush

@push('style')
    <style>
        .booking-table td {
            white-space: unset;
        }

        .guest-list {
            padding-left: 25px;
        }

        .guest-list li {
            list-style: circle;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/admin/js/room-selection.js') }}"></script>
    <script src="{{ asset('assets/admin/js/booking.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            let roomListHtml = @json(@$view);
            $('.bookingInfo').html(roomListHtml);

            updateOrderList();

            $('[name=paid_amount]').on('keypress', function(e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    $('.confirmBookingBtn').click();
                }
            })
        })(jQuery);
    </script>
@endpush
