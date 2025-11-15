@php
    $loginContent = getContent('login.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="account mt-60 mb-120">
        <div class="container">
            <div class="row gy-4 justify-content-center justify-content-lg-between">
                <div class="col-lg-7">
                    <div class="account-wrapper">
                        <h3 class="account__title"> {{ __($loginContent?->data_values?->heading) }} </h3>

                        <form method="POST" action="{{ route('user.login') }}" class="account-form verify-gcaptcha">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="email" class="form--label">@lang('Username or Email')</label>
                                    <input type="text" name="username" value="{{ old('username') }}" class="form--control" placeholder="@lang('Username or Email')" required>
                                </div>
                                <div class="col-sm-6 form-group">
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
                                    <button class="btn--base btn w-100 btn--lg"> @lang('Login') </button>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <a href="{{ route('user.password.request') }}" class="forget-password"> @lang('Forgot your password?') </a>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <p class="account-form__text"> @lang('Don\'t have any account? Register now to make reservations quickly and easily.') <a href="{{ route('user.register') }}"> @lang('Register Now') </a> </p>
                                </div>
                            </div>

                            @if (@gs('socialite_credentials')->linkedin->status || @gs('socialite_credentials')->facebook->status == Status::ENABLE || @gs('socialite_credentials')->google->status == Status::ENABLE)
                                @include('Template::partials.social_login')
                            @endif
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="account-thumb">
                        <img src="{{ frontendImage('login', $loginContent?->data_values?->image, '420x535') }}" alt="login">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
