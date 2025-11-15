@extends('admin.layouts.app')

@section('panel')
    @can('admin.offer.store')
        <form action="{{ route('admin.offer.store', $offer->id ?? 0) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gy-3">
                <div class="col-lg-12">
                    <div class="card bl--5 border--primary">
                        <div class="card-body">
                            <p class="text--primary"><i class="la la-info-circle"></i> @lang('If a room type has both offer fare and is part of an offer, the discount from the offer will still be applied on top of the fare per night. If the room type has already been a part of any previous offer, it will automatically be replaced by the new offer.')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">@lang('General Information')</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label>@lang('Offer Name') </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="offer_name" value="{{ old('offer_name', @$offer->name) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label>@lang('Discount Type')</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control" name="discount_type" required>
                                                <option value="" selected hidden>@lang('Select One')</option>
                                                <option value="{{ Status::DISCOUNT_FIXED }}">@lang('Flat')</option>
                                                <option value="{{ Status::DISCOUNT_PERCENT }}">@lang('Percentage')</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label>@lang('Amount')</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="number" step="any" class="form-control" name="amount" value="{{ old('amount', @$offer->amount) }}" required>
                                                <span class="input-group-text" id="amountType"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="starts_from">@lang('Starts From')</label>
                                        </div>

                                        <div class="col-md-9">
                                            <input type="text" name="starts_from" class="form-control" value="{{ old('starts_from') }}" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="ends_at">@lang('Ends At')</label>
                                        </div>

                                        <div class="col-md-9">
                                            <input type="text" name="ends_at" class="form-control" value="{{ old('ends_at') }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0">@lang('Room Type')</h5>
                            <button type="button" class="btn btn--primary addMoreProduct"><i class="la la-plus"></i>@lang('Add Room Type')</button>
                        </div>
                        <div class="card-body has-select2">
                            <x-room-type-picker :roomTypes="@$offer?->roomTypes" :url="route('admin.offer.room.types')" />
                            <small class="text-muted flat-discount-info"><i class="la la-info-circle"></i> @lang('Select room types carefully when the discount type is set to FLAT. If the discount amount is equal to or greater than the room type fare, the fare for these room types will be 0.')</small>
                        </div>
                    </div>
                </div>
                @can('admin.offer.store')
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                @endcan
            </div>
        </form>
    @endcan

    @stack('modal')
@endsection

@can('admin.offer.index')
    @push('breadcrumb-plugins')
        <x-back route="{{ route('admin.offer.index') }}"></x-back>
    @endpush
@endcan

@push('style-lib')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict';
        (function($) {
            const discountTypeField = $('[name=discount_type]');
            const startsFromField = $('[name=starts_from]');
            const endsAtField = $('[name=ends_at]');
            const discountType = `{{ old('discount_type', @$offer->discount_type) }}`;

            startsFromField.daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                drops: 'auto',
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            });

            endsAtField.daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                drops: 'auto',
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            });

            @if (isset($offer))
                let startDate = @json(showDateTime($offer->starts_from, 'Y-m-d h:i A'));
                let endDate = @json(showDateTime($offer->ends_at, 'Y-m-d h:i A'));

                startsFromField.data('daterangepicker').setStartDate(startDate);
                startsFromField.data('daterangepicker').setEndDate(startDate);
                endsAtField.data('daterangepicker').setStartDate(endDate);
                endsAtField.data('daterangepicker').setEndDate(endDate);
            @endif

            discountTypeField.val(discountType);

            const discountTypeChangeHandler = (value) => {
                $('.flat-discount-info').hide();
                if (discountTypeField.val() == '{{ Status::DISCOUNT_FIXED }}') {
                    $('#amountType').text(`{{ gs('cur_text') }}`);
                    $('.flat-discount-info').show();
                } else if (discountTypeField.val() == '{{ Status::DISCOUNT_PERCENT }}') {
                    $('.flat-discount-info').hide();
                    $('#amountType').text(`%`);
                }
            }

            discountTypeChangeHandler();
            discountTypeField.on('change', () => discountTypeChangeHandler());

        })(jQuery)
    </script>
@endpush

@push('style')
    <style>
        .image--uploader,
        .image-upload-wrapper {
            width: 250px;
        }
    </style>
@endpush
