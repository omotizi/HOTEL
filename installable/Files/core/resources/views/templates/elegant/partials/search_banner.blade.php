@php
    $breadcrumbImageContent = getContent('breadcrumb_images.content', true);
    $breadcrumb_image = 'blog_breadcrumb_image';
    $size = null;
    $searchData = session()->get('search_data');
@endphp

<section class="banner-section room-details-banner bg-img pb-0" data-background-image="{{ frontendImage('breadcrumb_images', @$breadcrumbImageContent->data_values->$breadcrumb_image, $size) }}">
    <div class="container h-100 flex-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <form action="{{ route('rooms') }}" class="filter-form" method="GET">
                        <div class="filter-form__item">
                            <div class="datepicker-inner">
                                <label class="form--label"> @lang('Check In') </label>
                                <input type="text" name="check_in" value="{{ isset($searchData['check_in']) ? $searchData['check_in'] : showDateTime(now(), 'Y-m-d') }}" placeholder="@lang('Enter date')" class="form--control datepicker2 flatpickr-input active" readonly="readonly">
                            </div>
                        </div>
                        <div class="filter-form__item">
                            <div class="datepicker-inner">
                                <label class="form--label"> @lang('Check Out') </label>
                                <input type="text" name="check_out" value="{{ isset($searchData['check_out']) ? $searchData['check_out'] : showDateTime(now()->addDay(), 'Y-m-d') }}" placeholder="@lang('Enter date')" class="form--control datepicker2 flatpickr-input active" readonly="readonly">
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
                                <button type="button" class="total-number"> <span class="adult_count">{{ isset($searchData['adult']) ? $searchData['adult'] : 1 }}</span>
                                    @lang('adults'), <span class="children_count">{{ isset($searchData['children']) ? $searchData['children'] : 0 }}</span>
                                    @lang('children') </button>
                                <div class="number-picker">
                                    <ul class="passenger-list">
                                        <li class="passenger-list__item">
                                            <div class="passenger-list__item-left">
                                                @lang('Adults') <span class="passenger-list__text"> @lang('12 years and above') </span>
                                            </div>
                                            <div class="qty-container">
                                                <button class="qty-btn-minus btn-light" data-count_for="adult_count" type="button"><i class="fa fa-minus"></i></button>
                                                <input type="number" name="adult" value="{{ isset($searchData['adult']) ? $searchData['adult'] : 1 }}" class="input-qty" />
                                                <button class="qty-btn-plus btn-light" data-count_for="adult_count" type="button"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </li>
                                        <li class="passenger-list__item">
                                            <div class="passenger-list__item-left">
                                                @lang('Children') <span class="passenger-list__text"> @lang('2 - 12 years')
                                                </span>
                                            </div>
                                            <div class="qty-container">
                                                <button class="qty-btn-minus btn-light" data-count_for="children_count" type="button"><i class="fa fa-minus"></i></button>
                                                <input type="number" name="children" value="{{ isset($searchData['children']) ? $searchData['children'] : 0 }}" class="input-qty" />
                                                <button class="qty-btn-plus btn-light" data-count_for="children_count" type="button"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="filter-form__item">
                            <button class="btn--base btn"> <span class="icon"> <i class="las la-search"></i> </span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.qty-btn-plus').on('click', function() {
                let countFor = $(this).data('count_for');
                let inputVal = $(this).parent(".qty-container").find(".input-qty");
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

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .form--control[readonly] {
            background-color: transparent !important;
        }
    </style>
@endpush
