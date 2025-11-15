@php
    $bannerContent = getContent('banner.content', true);
    $searchData = session()->get('search_data');
    if ($searchData) {
        $checkIn  = $searchData['check_in'];
        $checkout = $searchData['check_out'];
        $adult    = $searchData['adult'];
        $children = $searchData['children'];
    } else {
        $checkIn  = now()->format('Y-m-d');
        $checkout = now()->addDay(1)->format('Y-m-d');
        $adult    = 1;
        $children = 0;
    }
@endphp

<section class="hero-section bg_img" style="background-image: url('{{ getImage('assets/images/frontend/banner/' . $bannerContent?->data_values?->banner_image, '1800x800') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xxl-7">
                <h2 class="hero-section__title text-center">{{ __($bannerContent?->data_values?->heading) }}</h2>
            </div>
            <div class="col-lg-12 mt-5">
                <form action="{{ route('rooms') }}" autocomplete="off" method="get">
                    <div class="filter-wrapper">
                        <div class="row g-xxl-4 g-3">
                            <input name="check_in" type="hidden" value="{{ $checkIn }}">
                            <input name="check_out" type="hidden" value="{{ $checkout }}">
                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <div class="custom-icon-field">
                                    <input class="checkin-checkout-date form--control" data-language="en" data-multiple-dates-separator=" - " data-position='top left' data-range="true" placeholder="@lang('Check In - Check Out')" type="text">
                                    <i class="las la-calendar-alt"></i>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <div class="custom-icon-field">
                                    <input class="form--control" min="0" name="total_adult" placeholder="@lang('Total Adult')" type="number" value="{{ $adult }}">
                                    <i class="las la-male"></i>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <div class="custom-icon-field">
                                    <input class="form--control" min="0" name="total_child" placeholder="@lang('Total Child')" type="number" value="{{ $children }}">
                                    <i class="las la-child"></i>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-md-6">
                                <button class="btn fs--14px btn--base w-100 px-2" type="submit">@lang('CHECK AVAILABILITY')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.en.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            function formattedDate(date) {
                const d = new Date(date);

                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');

                return `${year}-${month}-${day}`;
            }

            var datepicker = $('.checkin-checkout-date').datepicker({
                autoClose: true,
                multipleDates: true,
                onSelect: function(dates) {
                    if (dates.match("-")) {
                        let dateArr = dates.split(' - ');
                        let checkIn = formattedDate(dateArr[0]);
                        $('[name=check_in]').val(checkIn);

                        if (typeof dateArr[1] != undefined) {
                            let checkout = formattedDate(dateArr[1]);
                            $('[name=check_out]').val(checkout);
                        }
                    }
                }
            });

            var minDate = `{{ $checkIn }}`;
            var maxDate = `{{ $checkout }}`;
            datepicker.data('datepicker').selectDate([new Date(minDate), new Date(maxDate)]);

        })(jQuery);
    </script>
@endpush
