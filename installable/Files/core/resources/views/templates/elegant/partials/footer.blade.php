@php
    $socialIcons = getContent('social_icon.element', false, null, true);
    $contact = getContent('contact_us.content', true);
    $policies = getContent('policy_pages.element', false, null, true);
@endphp

<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-sm-between gy-4 justify-content-start">
            <div class="col-md-6">
                <div class="footer-item">
                    <div class="footer-item__logo">
                        <a href="{{ route('home') }}"> <img src="{{ siteLogo() }}" alt=""></a>
                    </div>
                </div>
                <div class="footer-item">
                    <p class="footer-item__title"> @lang('Address:')</p>
                    <p class="footer-item__text"> {{ __($contact?->data_values?->address) }} </p>
                </div>
                <div class="footer-item">
                    <p class="footer-item__title"> @lang('Contact:')</p>
                    <a href="tel:{{ $contact?->data_values?->contact_number }}" class="footer-item__text"> +{{ $contact?->data_values?->contact_number }} </a>
                    <a href="mailto:{{ $contact?->data_values?->email_address }}" class="footer-item__text"> {{ $contact?->data_values?->email_address }} </a>
                </div>

                <ul class="social-list">
                    @foreach ($socialIcons as $socialIcon)
                        <li class="social-list__item"><a href="{{ $socialIcon->data_values->url }}" class="social-list__link" target="_blank"> @php echo  $socialIcon->data_values->social_icon @endphp </a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <div class="footer-menu-wrapper">
                    <ul class="footer-menu">
                        @foreach ($policies as $policy)
                            <li class="footer-menu__item"><a href="{{ route('policy.pages', $policy->slug) }}" class="footer-menu__link"> {{ __($policy->data_values->title) }} </a></li>
                        @endforeach
                    </ul>
                    <ul class="footer-menu">
                        @foreach ($pages as $k => $data)
                           <li class="footer-menu__item"><a href="{{ route('pages', $data->slug) }}" class="footer-menu__link"> {{ __(ucwords(strtolower($data->name))) }} </a></li>
                        @endforeach
                        <li class="footer-menu__item"><a href="{{ route('rooms') }}" class="footer-menu__link"> @lang('Room & Suites') </a></li>
                        <li class="footer-menu__item"><a href="{{ route('blog') }}" class="footer-menu__link"> @lang('News') </a>
                        <li class="footer-menu__item"><a href="{{ route('contact') }}" class="footer-menu__link"> @lang('Contact') </a></li>
                        <li class="footer-menu__item"><a href="{{ route('gallery') }}" class="footer-menu__link"> @lang('Galleries') </a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="footer-area__bottom">
            <p class="footer-area__bottom-text"> @lang('Copyright') &copy; {{ date('Y') }} @lang('All Right Reserved')</p>
            <ul class="footer-menu">
                @foreach ($policies as $policy)
                    <li class="footer-menu__item"><a href="{{ route('policy.pages', $policy->slug) }}" class="footer-menu__link">{{ __($policy->data_values->title) }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
