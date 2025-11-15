@if ($websiteInfo->theme_version == 'theme_four' && request()->routeIS('index'))
  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/vendors/bootstrap.min.css') }}">
  <!-- Fontawesome Icon CSS -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/fonts/fontawesome/css/all.min.css') }}">
  <!-- Icomoon Icon CSS -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/fonts/icomoon/style.css') }}">
  <!-- Date-range Picker -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/vendors/daterangepicker.css') }}">
  <!-- Magnific Popup CSS -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/vendors/magnific-popup.min.css') }}">
  <!-- Swiper Slider -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/vendors/swiper-bundle.min.css') }}">
  <!-- Nice Select -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/vendors/nice-select.css') }}">
  <!-- AOS Animation CSS -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/vendors/aos.min.css') }}">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/vendors/animate.min.css') }}">
  <!-- Main Style CSS -->
  <link rel="stylesheet" href="{{ asset('front/theme_four/assets/css/style.css') }}">
@endif
{{-- right-to-left css --}}
@if ($currentLanguageInfo->direction == 1)
  <link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/rtl.css') }}">
  <link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/rtl-responsive.css') }}">
  <style>
    .nice-select .current {
      margin-left: 25px
    }

    .hero-banner .banner-filter-form .form-block .icon {
    position: absolute;
    top: -2px;
    right: 0;
}

    .footer-area .footer-widget .footer-links a::before {
      right: 0;
    }
  </style>
@endif
