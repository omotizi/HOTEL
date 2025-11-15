<!DOCTYPE html>
<html @if ($currentLanguageInfo->direction == 1) dir="rtl" @endif>

<head>
  {{-- required meta tags --}}
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="description" content="@yield('meta-description')">
  <meta name="keywords" content="@yield('meta-keywords')">

  {{-- csrf-token for ajax request --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- title --}}
  <title>@yield('pageHeading') | {{ $websiteInfo->website_title }}</title>

  {{-- fav icon --}}
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/' . $websiteInfo->favicon) }}">

  {{-- include styles --}}

  @yield('styles')

  {{-- include website color --}}
  @includeIf('frontend.partials.website-color')
</head>

<body>
  {{-- preloader start --}}
  @if ($websiteInfo->preloader_status == 1)
    <div class="loader" id="preLoader">
      <img class="lazy" data-src="{{ asset('assets/img/' . $websiteInfo->preloader) }}" alt="">
    </div>
  @endif
  {{-- preloader end --}}

  {{-- header start --}}
  <header
    class="
    @if ($websiteInfo->theme_version == 'multipurpose_two') home-two 
    @elseif($websiteInfo->theme_version == 'theme_three') header-area header-2
    @elseif($websiteInfo->theme_version == 'theme_four') header-area header-3 
    @elseif($websiteInfo->theme_version == 'theme_five') header-area header-1 
    @endif
    ">
    {{-- include header-nav --}}
    @if ($websiteInfo->theme_version == 'multipurpose')
      {{-- include header-top --}}
      @includeIf('frontend.theme_one_two.partials.header_top_one')
      @includeIf('frontend.theme_one_two.partials.header_nav_one')
    @elseif ($websiteInfo->theme_version == 'multipurpose_two')
      {{-- include header-top --}}
      @includeIf('frontend.theme_one_two.partials.header_top_two')
      @includeIf('frontend.theme_one_two.partials.header_nav_two')
    @elseif ($websiteInfo->theme_version == 'theme_three')
      {{-- include header-top --}}
      <div class="container">
        @includeIf('frontend.theme_three.partials.header_top')
        @includeIf('frontend.theme_three.partials.header_nav')
      </div>
    @elseif ($websiteInfo->theme_version == 'theme_four')
      {{-- include header-top --}}
      @includeIf('frontend.theme_four.partials.header_top')
      @includeIf('frontend.theme_four.partials.header_nav')
    @elseif ($websiteInfo->theme_version == 'theme_five')
      {{-- include header-top --}}
       <div class="container">
        <div class="row g-0">
          @includeIf('frontend.theme_five.partials.header_top')
          @includeIf('frontend.theme_five.partials.header_nav')
        </div>
       </div>
    @endif
  </header>
  {{-- header end --}}

  @yield('content')

  {{-- back to top start --}}
  <div class="back-top">
    <a href="#" class="back-to-top">
      <i class="far fa-angle-up"></i>
    </a>
  </div>
  {{-- back to top end --}}

  {{-- include footer --}}
  @if ($websiteInfo->theme_version == 'multipurpose')
    @includeIf('frontend.theme_one_two.partials.footer')
  @elseif ($websiteInfo->theme_version == 'multipurpose_two')
    @includeIf('frontend.theme_one_two.partials.footer')
  @elseif ($websiteInfo->theme_version == 'theme_three')
    @includeIf('frontend.theme_three.partials.footer')
  @elseif ($websiteInfo->theme_version == 'theme_four')
    @includeIf('frontend.theme_four.partials.footer')
    @elseif ($websiteInfo->theme_version == 'theme_five')
    @includeIf('frontend.theme_five.partials.footer')
  @endif

  {{-- Popups start --}}
  @includeIf('frontend.partials.popups')
  {{-- Popups end --}}

  {{-- WhatsApp Chat Button --}}
  <div id="WAButton"></div>

  {{-- Cookie alert dialog start --}}
  @if (!empty($cookie) && $cookie->cookie_alert_status == 1)
    <div class="cookie">
      @include('cookie-consent::index')
    </div>
  @endif
  {{-- Cookie alert dialog end --}}

  {{-- include scripts --}}
  @yield('theme_scripts')

  {{-- additional script --}}
  @yield('script')
</body>

</html>
