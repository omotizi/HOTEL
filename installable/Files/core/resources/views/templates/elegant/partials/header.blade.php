@php
    $menuContent = getContent('room_suite_menu.content', true);
    $contact = getContent('contact_us.content', true);
    $socialElements = getContent('social_icon.element', false, null, true);
    $bannerContent = getContent('banner.content', true);
    $breadcrumbImage = getContent('breadcrumb_images.content', true);
@endphp

<div class="header-top d-lg-block d-none">
    <div class="container">
        <div class="top-header-wrapper d-flex flex-wrap justify-content-between align-items-center">
            <div class="top-contact">
                <ul class="contact-list">
                    <li class="contact-list__item">
                        <span class="contact-list__item-icon"> <i class="las la-envelope"></i> </span>
                        <a href="mailto:{{ $contact?->data_values?->email_address }}" class="contact-list__link">
                            {{ $contact?->data_values?->email_address }} </a>
                    </li>
                    <li class="contact-list__item">
                        <span class="contact-list__item-icon"> <i class="las la-phone-volume"></i> </span>
                        <a href="tel:{{ $contact?->data_values?->contact_number }}" class="contact-list__link">
                            {{ $contact?->data_values?->contact_number }} </a>
                    </li>
                </ul>
            </div>
            <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                <ul class="login-registration-list">
                    <li class="login-registration-list__item">
                        @if (auth()->check())
                            <span class="login-registration-list__icon"> <i class="las la-tachometer-alt"></i></span>
                            <a href="{{ route('user.home') }}" class="login-registration-list__link"> @lang('Dashboard')
                            </a>
                        @else
                            <span class="login-registration-list__icon"> <i class="las la-user"></i> </span>
                            <a href="{{ route('user.login') }}" class="login-registration-list__link"> @lang('LOGIN')
                            </a>
                        @endif
                    </li>
                    @if (gs('multi_language'))
                        <li class="login-registration-list__item">
                            @php
                                $language = App\Models\Language::all();
                                $selectLanguage = App\Models\Language::where('code', session('lang'))->first();
                            @endphp
                            <div class="custom--dropdown">
                                <div class="custom--dropdown__selected dropdown-list__item">
                                    <div class="language_flag">
                                        <img src="{{ getImage(getFilePath('language') . '/' . $selectLanguage->image, getFileSize('language')) }}" alt="flag">
                                        <span class="text"> {{ __($selectLanguage->name) }} </span>
                                    </div>
                                </div>
                                <div class="dropdown-list">
                                    @foreach ($language as $lang)
                                        @if ($lang->id != $selectLanguage->id)
                                            <a class="dropdown-list__item" href="{{ route('lang', $lang->code) }}">
                                                <span class="language_flag">
                                                    <img src="{{ getImage(getFilePath('language') . '/' . $lang->image, getFileSize('language')) }}" alt="image">
                                                    <span class="text"> {{ __($lang->name) }} </span>
                                                </span>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

@if (request()->routeIs(['home', 'rooms']) || @$banner == false)
    <header class="header" id="header">
    @else
        <header class="header header--addon bg-overlay bg-white" id="header">
            <img class="header--addon-img" src="{{ frontendImage('breadcrumb_images', @$breadcrumbImage->data_values->breadcrumb_image, '1920x365') }}" alt="overlay">
@endif
<div class="header-bottom">
    <div class="container">
        <div class="header-bottom__wrapper">
            <div class="top-list">
                <a href="{{ route('gallery') }}" class="top-list__link"> @lang('GALLERIES') </a>
                <a href="{{ route('video') }}" class="top-list__link"> @lang('VIDEOS') </a>
            </div>

            <a class="navbar-brand dark-logo logo" href="{{ route('home') }}"><img src="{{ siteLogo('dark') }}" alt=""></a>
            <a class="navbar-brand light-logo logo" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt=""></a>
            <div class="header-bottom__right">
                <a href="{{ route('contact') }}" class="header-bottom__btn"> @lang('CONTACT US') </a>
                <a href="{{ route('rooms') }}" class="btn btn--base box--shadow"> @lang('BOOK NOW') </a>
            </div>
        </div>
    </div>
</div>
<div class="main-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo d-lg-none d-block" href="{{ route('home') }}"><img src="{{ siteLogo('dark') }}" alt="logo"></a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu m-auto align-items-lg-center">
                    <li class="nav-item d-block d-lg-none">
                        <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                            <ul class="login-registration-list justify-content-between w-100">
                                <li class="login-registration-list__item">
                                    @if (auth()->check())
                                        <span class="login-registration-list__icon"> <i class="las la-tachometer-alt"></i></span>
                                        <a href="{{ route('user.home') }}" class="login-registration-list__link">
                                            @lang('Dashboard') </a>
                                    @else
                                        <span class="login-registration-list__icon"> <i class="las la-user"></i> </span>
                                        <a href="{{ route('user.login') }}" class="login-registration-list__link">
                                            @lang('LOGIN') </a>
                                    @endif
                                </li>

                                @if (gs('multi_language'))
                                    <li class="login-registration-list__item">
                                        <div class="custom--dropdown">
                                            <div class="custom--dropdown__selected dropdown-list__item">
                                                <div class="language_flag">
                                                    <img src="{{ getImage(getFilePath('language') . '/' . $selectLanguage->image, getFileSize('language')) }}" alt="flag">
                                                    <span class="text"> {{ __(strtoupper($selectLanguage->code)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-list">
                                                @foreach ($language as $lang)
                                                    @if ($lang->id != $selectLanguage->id)
                                                        <a class="dropdown-list__item" href="{{ route('lang', $lang->code) }}">
                                                            <span class="language_flag">
                                                                <img class="thumb" src="{{ getImage(getFilePath('language') . '/' . $lang->image, getFileSize('language')) }}" alt="image">
                                                                <span class="text">
                                                                    {{ __(strtoupper($lang->code)) }} </span>
                                                            </span>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}"> @lang('HOME') </a>
                    </li>

                    @foreach ($pages as $k => $data)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages', $data->slug) }}">{{ __($data->name) }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item has-mega-menu">
                        <a class="nav-link" aria-current="page" href="{{ route('rooms') }}"> @lang('ROOMS & SUITES') </a>
                        <div class="mega-menu-wrapper">
                            <div class="container p-0">
                                <div class="mega-menu">
                                    <div class="mega-menu__left">
                                        <h6 class="title">@lang('Rooms & Suits') </h6>
                                        <div class="mega-menu__left-content">
                                            <p class="content-text">
                                                {{ __($menuContent->data_values->short_description) }}
                                            </p>
                                            <div class="content-btn">
                                                <a href="{{ route('rooms') }}" class="btn">
                                                    @lang('Explore All Rooms')
                                                </a>
                                            </div>
                                            <a href="{{ route('rooms') }}" class="btn-link">
                                                @lang('Check for availability')
                                                <span class="icon">
                                                    <i class="las la-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mega-menu__right">
                                        <div class="room-slider">
                                            @foreach ($featureRoomTypes as $roomType)
                                                <div class="room-item">
                                                    <a href="{{ route('room.type.details', $roomType->slug) }}" class="room-item__thumb">
                                                        <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$roomType->main_image, getFileSize('roomTypeImage')) }}" alt="room">
                                                    </a>
                                                    <div class="room-item__content">
                                                        <h6 class="room-item__title">
                                                            <a href="{{ route('room.type.details', $roomType->slug) }}" class="room-item__title-link">
                                                                {{ __($roomType->name) }}
                                                            </a>
                                                        </h6>
                                                        <p class="room-item__desc">
                                                            @lang('Rate from') {{ showAmount($roomType->fare) }}
                                                            @lang('per night')
                                                        </p>
                                                        <a href="{{ route('room.type.details', $roomType->slug) }}" class="btn-link">
                                                            @lang('Check for availability')
                                                            <span class="icon">
                                                                <i class="las la-arrow-right"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog') }}"> @lang('NEWS') </a>
                    </li>
                    <li>
                        <div class="header-bottom__wrapper">
                            <div class="d-block d-lg-none w-100">
                                <div class="gallery-item">
                                    <a href="{{ route('gallery') }}" class="gallery-item__link"> @lang('GALLERY')
                                    </a>
                                    <a href="{{ route('video') }}" class="gallery-item__link"> @lang('VIDEOS')
                                    </a>
                                </div>
                            </div>
                            <div class="d-block d-lg-none w-100">
                                <div class="header-bottom__right">
                                    <a href="{{ route('contact') }}" class="header-bottom__btn"> @lang('CONTACT US')</a>
                                    <a href="{{ route('rooms') }}" class="btn btn--sm btn--base box--shadow">@lang('BOOK NOW')</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
</header>
