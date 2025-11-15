@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $registerContent = getContent('register.content', true);
    @endphp

    <div class="account mt-60 mb-120">
        <div class="container">
            <h3 class="account__title"> {{ __($registerContent?->data_values?->heading) }} </h3>
            <div class="row gy-4 justify-content-center justify-content-lg-between">
                <div class="col-lg-7">
                    <div class="account-wrapper">
                        @if (gs('registration'))
                            <div class="account-wrapper__top">
                                <h5 class="title">@lang('Profile Information')</h5>
                            </div>
                        @endif
                        <form action="{{ route('user.register') }}" class="account-form disableSubmission  verify-gcaptcha @if (!gs('registration')) form-disabled @endif" method="post">
                            @csrf

                            @if (!gs('registration'))
                                @php
                                    $color = '#' . gs('base_color');
                                @endphp
                                <div class="form-disabled-text">
                                    <svg class="" style="enable-background:new 0 0 512 512" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                            <path class="" data-original="{{ $color }}" d="M255.999 0c-79.044 0-143.352 64.308-143.352 143.353v70.193c0 4.78 3.879 8.656 8.659 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193c0-42.998 34.981-77.98 77.979-77.98s77.979 34.982 77.979 77.98v70.193c0 4.78 3.88 8.656 8.661 8.656h48.057a8.657 8.657 0 0 0 8.656-8.656v-70.193C399.352 64.308 335.044 0 255.999 0zM382.04 204.89h-30.748v-61.537c0-52.544-42.748-95.292-95.291-95.292s-95.291 42.748-95.291 95.292v61.537h-30.748v-61.537c0-69.499 56.54-126.04 126.038-126.04 69.499 0 126.04 56.541 126.04 126.04v61.537z" fill="{{ $color }}" opacity="1"></path>
                                            <path class="" data-original="{{ $color }}" d="M410.63 204.89H101.371c-20.505 0-37.188 16.683-37.188 37.188v232.734c0 20.505 16.683 37.188 37.188 37.188H410.63c20.505 0 37.187-16.683 37.187-37.189V242.078c0-20.505-16.682-37.188-37.187-37.188zm19.875 269.921c0 10.96-8.916 19.876-19.875 19.876H101.371c-10.96 0-19.876-8.916-19.876-19.876V242.078c0-10.96 8.916-19.876 19.876-19.876H410.63c10.959 0 19.875 8.916 19.875 19.876v232.733z" fill="{{ $color }}" opacity="1"></path>
                                            <path class="" data-original="{{ $color }}" d="M285.11 369.781c10.113-8.521 15.998-20.978 15.998-34.365 0-24.873-20.236-45.109-45.109-45.109-24.874 0-45.11 20.236-45.11 45.109 0 13.387 5.885 25.844 16 34.367l-9.731 46.362a8.66 8.66 0 0 0 8.472 10.436h60.738a8.654 8.654 0 0 0 8.47-10.434l-9.728-46.366zm-14.259-10.961a8.658 8.658 0 0 0-3.824 9.081l8.68 41.366h-39.415l8.682-41.363a8.655 8.655 0 0 0-3.824-9.081c-8.108-5.16-12.948-13.911-12.948-23.406 0-15.327 12.469-27.796 27.797-27.796 15.327 0 27.796 12.469 27.796 27.796.002 9.497-4.838 18.246-12.944 23.403z" fill="{{ $color }}" opacity="1"></path>
                                        </g>
                                    </svg>
                                    <div class="mt-3">
                                        <a href="{{ route('home') }}" class="btn btn--base"> <i class="las la-arrow-left"></i> @lang('Go to Home')</a>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label class="form--label"> @lang('First Name') </label>
                                    <input type="text" class="form--control" name="firstname" placeholder="@lang('First Name')" value="{{ old('firstname') }}" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form--label">@lang('Last Name') </label>
                                    <input type="text" class="form--control" name="lastname" placeholder="@lang('Last Name')" value="{{ old('lastname') }}" required>
                                </div>
                                <div class="col-12 form-group">
                                    <label class="form--label"> @lang('Email Address') </label>
                                    <input class="form--control checkUser" name="email" placeholder="@lang('Email Address')" required type="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="account-form__item">
                                <h5 class="title">@lang('Password') </h5>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <div class="position-relative">
                                            <input id="your-password" type="password" class="form-control form--control @if (gs('secure_password')) secure-password @endif" name="password" placeholder="@lang('Password')" required>
                                            <span class="password-show-hide fas toggle-password fa-eye-slash" id="#your-password"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <div class="position-relative">
                                            <input id="confirm-password" type="password" class="form-control form--control" name="password_confirmation" placeholder="@lang('Confirm Password')" required>
                                            <span class="password-show-hide fas toggle-password fa-eye-slash" id="#confirm-password"></span>
                                        </div>
                                    </div>
                                </div>
                                @if (gs('secure_password'))
                                    <p class="account-form__text">
                                        @lang('Password must be 6+ characters, case-sensitive with an uppercase letter, allow !$#%, no spaces, and differ from previous passwords.')
                                    </p>
                                @endif
                            </div>

                            <x-captcha :custom=true marginTop='mt-4' />

                            @if (gs('agree'))
                                <div class="account-form__item">
                                    <h5 class="title"> @lang('Acknowledgement') </h5>
                                    <div class="form--check">
                                        <input @checked(old('agree')) class="form-check-input" id="agree" name="agree" type="checkbox" required>
                                        <label class="form-check-label" for="agree">
                                            {{ __(@$registerContent->data_values->acknowledgement) }}
                                            @lang('I agree with') @foreach ($policyPages as $policy)
                                                <a class="text--base" href="{{ route('policy.pages', $policy->slug) }}" target="_blank">{{ __($policy->data_values->title) }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <div class="account-form__btn">
                                <button type="submit" class="btn btn--base"> @lang('Register') </button>
                            </div>

                            @if(@gs('socialite_credentials')->linkedin->status || @gs('socialite_credentials')->facebook->status == Status::ENABLE || @gs('socialite_credentials')->google->status == Status::ENABLE)
                                @include($activeTemplate . 'partials.social_login')
                            @endif
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="account-thumb">
                        <img src="{{ frontendImage('register', @$registerContent->data_values->image) }}" alt="register">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div aria-hidden="true" aria-labelledby="existModalCenterTitle" class="modal fade" id="existModalCenter" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark btn-sm" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                    <a class="btn btn--base btn-sm" href="{{ route('user.login') }}">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
@push('script')
    <script>
        "use strict";
        (function($) {

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                var data = {
                    email: value,
                    _token: token
                }

                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $('#existModalCenter').modal('show');
                    }
                });
            });

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .form-disabled {
            overflow: hidden;
            position: relative;
        }

        .form-disabled::after {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            top: 0;
            left: 0;
            backdrop-filter: blur(2px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .form-disabled-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 991;
            font-size: 1rem;
            height: auto;
            width: 100%;
            text-align: center;
            line-height: 1.2;
        }

        .form-disabled__desc {
            font-size: 1.125rem;
            max-width: 450px;
            margin: 0 auto;
            margin-top: 20px;
        }
    </style>
@endpush
