{{-- bootstrap css --}}
<link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/bootstrap.min.css') }}">

{{-- jQuery-ui css --}}
<link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/jquery-ui.min.css') }}">

{{-- plugins css --}}
<link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/plugins.min.css') }}">

{{-- default css --}}
<link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/default.css') }}">

{{-- main css --}}
<link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/main.css') }}">

{{-- responsive css --}}
<link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/responsive.css') }}">

{{-- right-to-left css --}}
@if ($currentLanguageInfo->direction == 1)
  <link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/rtl.css') }}">
  <link rel="stylesheet" href="{{ asset('front/theme_one_two/assets/css/rtl-responsive.css') }}">
  <style>
    .header-area.header-1::before {
      right: 0;

    }
    .footer-area .footer-widget .footer-links a::before {
      right: 0;
    }
  </style>
@endif
@if ($websiteInfo->theme_version == 'theme_three' || $websiteInfo->theme_version == 'theme_four')
  <link rel="stylesheet" href="{{ asset('front/theme_three/assets/css/vendors/bootstrap.min.css') }}">
  <!-- Main Style CSS -->
  <link rel="stylesheet" href="{{ asset('front/theme_three/assets/css/style.css') }}">

@endif
@if($websiteInfo->theme_version == 'theme_five')
 <link rel="stylesheet" href="{{ asset('front/theme_five/assets/css/vendors/bootstrap.min.css') }}">
  <!-- Main Style CSS -->
 <link rel="stylesheet" href="{{ asset('front/theme_five/assets/css/style.css') }}">
@endif
