@php
    $content = getContent('password_reset.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="my-60">
        <div class="container">
            <div class="row align-items-lg-center justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <div class="custom--card">
                        <div class="card-header">
                            <h5 class="card-title text-center">@lang('Reset Password')</h5>
                        </div>
                        <div class="card-body">
                            <p class="subtitle">@lang('Your account is verified successfully. Now you can change your password. Please enter a strong password and don\'t share it with anyone.')</p>
                            <form method="POST" action="{{ route('user.password.update') }}" class="account-form mt-3">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <div class="secure-password-popup">
                                        <label class="form--label">@lang('Password')</label>
                                        <div class="position-relative">
                                            <input id="your-password" type="password" class="form-control form--control @if (gs('secure_password')) secure-password @endif" name="password" placeholder="@lang('Password')" required>
                                            <span class="password-show-hide fas toggle-password fa-eye-slash" id="#your-password"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form--label">@lang('Confirm Password')</label>
                                    <div class="position-relative">
                                        <input id="confirm-password" type="password" class="form-control form--control" name="password_confirmation" placeholder="@lang('Confirm Password')" required>
                                        <span class="password-show-hide fas toggle-password fa-eye-slash" id="#confirm-password"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn--base btn--lg w-100"> @lang('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (gs()->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        $('.input-eye i').on('click', function() {
            let element = document.getElementById('password');
            if (this.classList.contains('fa-eye')) {
                this.classList.add('fa-eye-slash')
                this.classList.remove('fa-eye')
            } else {
                this.classList.add('fa-eye')
                this.classList.remove('fa-eye-slash')
            }
            if (element.type == 'password') {
                element.type = "text";
            } else {
                element.type = "password";
            }
        });
    </script>
@endpush
