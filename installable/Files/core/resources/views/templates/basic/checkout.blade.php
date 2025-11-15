@php
    $acknowledgement = getContent('acknowledgement.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="checkout-section pb-100 pt-100">
        <div class="container">
            <div class="row justify-content-center gy-4">
                <div class="col-lg-8">
                    <div class="checkout-wrapper">
                        <div class="checkout-wrapper__top">
                            <h3 class="checkout-wrapper__title">
                                <a href="{{ route('rooms') }}" class="checkout-wrapper__title-link">
                                    <span class="icon"> <i class="las la-arrow-left"></i> </span>
                                    @lang('Request to book')
                                </a>
                            </h3>
                            @guest
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn cmn-btn w-100 loginBtn"> @lang('Sign in for a faster booking') </button>
                                    </div>
                                </div>
                            @endguest
                        </div>
                        <div class="checkout-wrapper__body">
                            <form action="{{ route('checkout.store') }}" class="main-form" method="post">
                                @csrf
                                <div class="information-form mb-4">
                                    <div class="information-form__top">
                                        <h4 class="information-form__title"> @lang('Contact Info') </h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('First Name')</label>
                                                <input type="text" class="form--control" name="firstname" placeholder="@lang('First Name')" value="{{ old('firstname', auth()->user()->firstname ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('Last Name')</label>
                                                <input type="text" class="form--control" name="lastname" placeholder="@lang('Last Name')" value="{{ old('lastname', auth()->user()->lastname ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('Email Address')</label>
                                                <input class="form--control checkUser" name="email" placeholder="@lang('Email Address')" required type="email" value="{{ old('email', auth()->user()->email ?? '') }}">
                                                <small class="text--danger emailExist"></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('Country')</label>
                                                <select name="country" class="form--control  select2" required>
                                                    @foreach ($countries as $key => $country)
                                                        <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}" @selected(old('country') == $country->country)>
                                                            {{ __($country->country) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('Mobile')</label>
                                                <div class="input-group">
                                                    <span class="input-group-text mobile-code"></span>
                                                    <input type="hidden" name="mobile_code">
                                                    <input type="hidden" name="country_code">
                                                    <input type="number" name="mobile" value="{{ old('mobile', auth()->user()->mobile ?? '') }}" class="form-control form--control checkUser" required>
                                                </div>
                                                <small class="text--danger mobileExist"></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>@lang('Address')</label>
                                                <input class="form--control" name="address" placeholder="@lang('Address')" required type="text" value="{{ old('address', auth()->user()->address ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="main-form">
                                    @guest
                                        <div class="accordion custom--accordion booking-accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        @lang('Want to book faster? Create an account!')
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="form--check form-group m-0">
                                                            <input class="form-check-input" type="checkbox" name="create_account" value="1" id="flexCheckDefault6" @checked(old('create_account') == 1)>
                                                            <label class="form-check-label text--base" for="flexCheckDefault6">
                                                                @lang('Yes, I would like to create an account.')
                                                            </label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="form-group">
                                                                <label class="form--label">@lang('Password')</label>
                                                                <div class="position-relative">
                                                                    <input id="your-password" type="password" class="form-control form--control @if (gs('secure_password')) secure-password @endif" name="password" placeholder="@lang('Password')">
                                                                    <span class="password-show-hide fas toggle-password fa-eye-slash" id="#your-password"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form--label">@lang('Confirm Password')</label>
                                                                <div class="position-relative">
                                                                    <input id="confirm-password" type="password" class="form-control form--control" name="password_confirmation" placeholder="@lang('Confirm Password')">
                                                                    <span class="password-show-hide fas toggle-password fa-eye-slash" id="#confirm-password"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endguest
                                    <div class="booking-information">
                                        <div class="accordion custom--accordion booking-accordion" id="accordionTwo">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                        @lang('Reservation Details')
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionTwo" show>
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">@lang('Special Requests')</label>
                                                                    <input type="text" name="special_request" value="{{ old('special_request') }}" class="form--control" placeholder="@lang('Please note your requests, special occasions or room preferences')">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label"> @lang('Arrival')</label>
                                                                    <input type="time" name="arrival" value="{{ old('arrival') }}" class="form--control form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="form-label"> @lang('Departure')</label>
                                                                    <input type="time" name="departure" value="{{ old('departure') }}" class="form--control form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="policy-item">
                                    <h4 class="policy-item__title"> @lang('Policies') </h4>
                                    <div class="policy-item__content section-bg-two">
                                        <div class="policy-item__top">
                                            <div class="policy-item__time">
                                                <span class="text">@lang('Check-in')</span>
                                                <span class="time">@lang('After') {{ showDateTime(gs('checkin_time'), 'h:i A') }}</span>
                                            </div>
                                            <div class="policy-item__time">
                                                <span class="text">@lang('Check-out')</span>
                                                <span class="time">@lang('Before') {{ showDateTime(gs('checkout_time'), 'h:i A') }}</span>
                                            </div>
                                        </div>
                                        <h6 class="mt-3 mb-2">@lang('Cancellation Policies')</h6>
                                        @foreach ($carts as $cart)
                                            @if (strip_tags($cart->roomType->cancellation_policy))
                                                <div class="cancelation-policies">
                                                    <p class="policy-item__text"> {{ __($cart->roomType->name) }}</p>
                                                    <div class="desc">
                                                        @php echo $cart->roomType->cancellation_policy @endphp
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if ($acknowledgement)
                                    <div class="checkout-wrapper__bottom">
                                        <h4 class="title"> @lang('Acknowledgement') </h4>
                                        <div class="form--check form-group">
                                            <input class="form-check-input" type="checkbox" value="1" name="acknowledgement" id="acknowledgement" required>
                                            <label class="form-check-label" for="acknowledgement">@php echo $acknowledgement->data_values->details; @endphp</label>
                                        </div>

                                    </div>
                                @endif
                                @if ($cartCount)
                                    <div class="payment-btn">
                                        <button class="btn btn--base btn--lg" type="submit"><i class="las la-check-circle"></i> @lang('Confirm The Booking Request') </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="addon-sidebar">
                        <h6 class="addon-sidebar__amount mb-0"> @lang('Total Amount:') {{ showAmount($totalAmountWithTax) }}</h6>
                        <p>@lang('Total') {{ $carts->sum('quantity') }} @lang('rooms') (@lang('Including taxes and fees'))</p>
                        @foreach ($carts as $cart)
                            <div class="sidebar-item">
                                <ul class="amount-list">
                                    <li class="amount-list__item">
                                        <div>
                                            <p class="amount-list__title text--base"> {{ @$cart->roomType->name }}:</p>
                                            @if (isset($cart->roomType->beds) && count($cart->roomType->beds))
                                                @php
                                                    $beds = array_count_values($cart->roomType->beds);
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

                                            @if (@$cart->roomType->room_suite == Status::SUITE)
                                                @foreach ($cart->roomType->suitesTypeRooms->groupBy('room_type') as $key => $suiteTypeRoom)
                                                    <span class="amount-list__number">{{ __(keyToTitle($key)) }}({{ $suiteTypeRoom->count() }})</span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span class="amount-list__price"> {{ showAmount($cart->fare) }}
                                        </span>
                                    </li>
                                    <li class="amount-list__item">
                                        <div>
                                            <p class="amount-list__title"> @lang('Number of Room :') {{ $cart->quantity }}
                                            </p>
                                            <p class="amount-list__number">
                                                <span class="time">
                                                    {{ daysDifference($cart->check_in, $cart->check_out) }}
                                                    @lang('Night Stay') </span>
                                            </p>
                                        </div>
                                        <span class="amount-list__price">
                                            {{ showAmount($cart->total_fare) }}
                                        </span>
                                    </li>
                                    <li class="amount-list__item">
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="amount-list__icon"> <i class="las la-calendar-day"></i> </span>
                                            <span class="amount-list__text">
                                                {{ showDateTime($cart->check_in, 'D, d M Y') }} -
                                                {{ showDateTime($cart->check_out, 'D, d M Y') }} </span>
                                        </div>
                                    </li>
                                    <li class="amount-list__item btn-wrapper">
                                        <div>
                                            <p class="amount-list__title">
                                                <span class="icon"> <i class="las la-user"></i></span>
                                                {{ $cart->adult . ' ' . __(str()->plural('Adult', $cart->adult)) }}@if ($cart->children > 0)
                                                    , {{ $cart->children . ' ' . __(str()->plural('Child', $cart->children)) }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="remove-btn-wrapper">
                                            <button type="butotn" class="btn btn-outline--danger btn-sm confirmationBtn" data-action="{{ route('selected.room.remove', $cart->id) }}" data-question="@lang('Are you sure you want to remove this room?')"><i class="las la-trash-alt"></i> @lang('Remove')</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach

                        <div class="sidebar-item">
                            <ul class="amount-list">
                                <li class="amount-list__item d-flex align-items-center">
                                    <div class="amount-list__btn mt-0">
                                        <p>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket-percent-icon lucide-ticket-percent">
                                                <path d="M2 9a3 3 0 1 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 1 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                                                <path d="M9 9h.01"></path>
                                                <path d="m15 9-6 6"></path>
                                                <path d="M15 15h.01"></path>
                                            </svg>
                                            <span class="ms-2 applyLabel">
                                                @if ($discountAmount)
                                                    @lang('Coupon Applied')
                                                @else
                                                    @lang('Apply Coupon')
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-2 couponForm">
                                <form action="" class="couponFormSubmit">
                                    <div class="input-group @if ($discountAmount) d-none @endif">
                                        <input type="text" name="coupon_code" class="form-control form--control" placeholder="Enter Coupon Code">
                                        <button type="submit" class="input-group-text applyCouponBtn">@lang('Apply')</button>
                                    </div>
                                    <div class="d-flex justify-content-between appliedCouponWrapper @if (!$discountAmount) d-none @endif flex-wrap gap-2">
                                        <div>
                                            <small class="amount-list__title">
                                                @lang('Code:') <span class="text--base showCouponCode">{{ $discountAmount ? $couponCode : '' }}</span>
                                            </small>

                                            <small class="removeCoupon text--danger"> <i class="las la-trash-alt"></i> @lang('Remove Coupon')</small>
                                        </div>

                                        <span class="amount-list__price showCouponAmount"> -{{ showAmount($discountAmount) }} </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="sidebar-item">
                            <li class="amount-list__item">
                                <div>
                                    <p class="amount-list__title">{{ __(gs('tax_name')) }} ({{ gs('tax') }}%) </p>
                                </div>
                                <span class="amount-list__price showTax"> {{ showAmount($totalTax) }} </span>
                            </li>
                        </div>

                        <div class="addon-sidebar__bottom">
                            <div class="addon-sidebar__total">
                                <div>
                                    <p class="addon-sidebar__amount">
                                        @lang('Total:')
                                    </p>
                                    <p class="addon-sidebar__vat">@lang('Including Taxes')</p>
                                </div>
                                <p class="addon-sidebar__total-amount showTotalAmountWithTax">{{ showAmount($totalAmountWithTax) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @guest
        <div class="modal custom--modal fade" id="loginModal" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="existModalLongTitle">@lang('Sign in for a faster booking')</h5>
                        <span aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="form--label">@lang('Username or Email')</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form--control" placeholder="@lang('Username or Email')" required>
                            </div>
                            <div class="form-group">
                                <label class="form--label"> @lang('Password')</label>
                                <div class="position-relative">
                                    <input id="your-password" type="password" class="form-control form--control" name="password" placeholder="@lang('Password')" required>
                                    <span class="password-show-hide fas toggle-password fa-eye-slash" id="#your-password">
                                    </span>
                                </div>
                            </div>

                            <x-captcha :custom=true />

                            <div class="form-group form--check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    @lang('Remember Me')
                                </label>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button class="btn--base btn w-100 btn--lg"> @lang('Sign In') </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endguest

    <x-confirmation-modal />
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.couponFormSubmit').on('submit', function(e) {
                e.preventDefault();
                let couponCode = $('[name=coupon_code]').val();
                if (!couponCode) {
                    notify('error', 'Coupon code is required')
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: `{{ route('apply.coupon') }}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "coupon_code": couponCode
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('.couponForm').find('.input-group').addClass('d-none');
                            $('.appliedCouponWrapper').removeClass('d-none');
                            $('.showCouponCode').text(response.coupon_code);
                            $('.showCouponAmount').text(response.discount_amount);
                            $('.showTotalAmountWithTax').text(response.total_amount_with_text);
                            $('.showTax').text(response.total_tax);

                            $('.applyLabel').text(`@lang('Coupon Applied')`);
                            $('.removeCoupon').removeClass('d-none');
                            notify('success', response.message);
                        } else {
                            if (Array.isArray(response.error)) {
                                response.error.forEach(element => {
                                    notify('error', element.message);
                                });
                            } else {
                                notify('error', response.message);
                            }
                        }
                    }
                });
            })

            $('.removeCoupon').on('click', function() {
                $.ajax({
                    type: "POST",
                    url: `{{ route('remove.coupon') }}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('.couponForm').find('.input-group').removeClass('d-none');
                        $('[name=coupon_code]').val('');
                        $('.showCouponBox').addClass('d-none');
                        $('.showCouponCode').text('');
                        $('.showCouponAmount').text(response.coupon_amount);
                        $('.showTotalAmountWithTax').text(response.total_amount_with_tax);
                        $('.showTax').text(response.total_tax);
                        $(".appliedCouponWrapper").addClass('d-none');
                        $('.applyLabel').text(`@lang('Apply Coupon')`);
                        $('.removeCoupon').addClass('d-none');
                        notify('success', response.message);
                    }
                });
            });

            let mobileCode = `{{ auth()->user()->dial_code ?? @$mobileCode }}`;

            if (mobileCode) {
                $(`option[data-code=${mobileCode}]`).attr('selected', '');
            }

            $('.select2').select2();

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.loginBtn').on('click', function() {
                let modal = $('#loginModal');
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .removeCoupon {
            cursor: pointer !important;
        }
    </style>
@endpush
