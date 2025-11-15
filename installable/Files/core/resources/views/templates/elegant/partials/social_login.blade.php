@php
    $text = Route::is('user.register') ? 'Register' : 'Login';
@endphp

<div class="social-login-wrapper">
    <p class="social-login-wrapper__text"> @lang('Or continue with') </p>

    <ul class="social-login-list">
        @if (gs('socialite_credentials')->google->status == Status::ENABLE)
            <li class="social-login-list__item flex-grow-1">
                <a href="{{ route('user.social.login', 'google') }}" class="social-login-list__link w-100  outline-btn btn">
                    <span class="social-login-list__icon">
                        <img src="{{ asset($activeTemplateTrue."images/google.svg") }}" alt="Google">
                    </span> @lang($text . ' With Google')
                </a>
            </li>
        @endif
        @if (gs('socialite_credentials')->facebook->status == Status::ENABLE)
            <li class="social-login-list__item flex-grow-1">
                <a href="{{ route('user.social.login', 'facebook') }}" class="social-login-list__link w-100  outline-btn btn">
                    <span class="social-login-list__icon">
                        <img src="{{ asset($activeTemplateTrue."images/facebook.svg") }}" alt="Facebook">
                    </span> @lang($text . ' With Facebook')
                </a>
            </li>
        @endif
        @if (gs('socialite_credentials')->linkedin->status == Status::ENABLE)
            <li class="social-login-list__item flex-grow-1">
                <a href="{{ route('user.social.login', 'linkedin') }}" class="social-login-list__link w-100  outline-btn btn">
                    <span class="social-login-list__icon">
                        <img src="{{ asset($activeTemplateTrue."images/linkdin.svg") }}" alt="Linkedin">
                    </span> @lang($text . ' With linkedin')
                </a>
            </li>
        @endif
    </ul>
</div>
