@php
    $content = getContent('account_recovery.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="my-60">
        <div class="container">
            <div class="d-flex align-items-lg-center justify-content-center">
                <div class="col-lg-6 col-xl-5 col-md-8">
                    <div class="custom--card">
                        <div class="card-header">
                            <h5 class="card-title text-center">{{ __($pageTitle) }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="subtitle">@lang('To recover your account please provide your email or username to find your account.')</p>
                            <form action="{{ route('user.password.email') }}" class="account-form verify-gcaptcha mt-3" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form--label">@lang('Username or Email')</label>
                                    <input class="form--control" name="value" placeholder="@lang('Username or email')" required type="text" value="{{ old('username') }}">
                                </div>
                                <x-captcha />
                                <button class="btn btn--base btn--lg w-100" type="submit">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
