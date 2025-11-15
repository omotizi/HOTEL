<script>
  "use strict";

  var rtl = {{ $currentLanguageInfo->direction }};
  var baseURL = "{!! url('/') !!}";
  var vapid_public_key = "{!! env('VAPID_PUBLIC_KEY') !!}";
</script>
{{-- bootstrap css --}}
@if ($websiteInfo->theme_version == 'theme_five' && request()->routeIS('index'))
<!-- Jquery JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/jquery.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/bootstrap.min.js') }}"></script>
    <!-- Date-range Picker JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/moment.min.js') }}"></script>
    <script src="{{ asset('front/theme_five/assets/js/vendors/daterangepicker.js') }}"></script>
    <!-- Counter JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/jquery.counterup.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/jquery.nice-select.min.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/jquery.magnific-popup.min.js') }}"></script>
    <!-- Swiper Slider JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/swiper-bundle.min.js') }}"></script>
    <!-- Lazysizes -->
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.min.js"></script>
    <script src="{{ asset('front/theme_five/assets/js/vendors/lazysizes.min.js') }}"></script>
    <!-- AOS JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/aos.min.js') }}"></script>
    <!-- Mouse Hover JS -->
    <script src="{{ asset('front/theme_five/assets/js/vendors/mouse-hover-move.js') }}"></script>
    <!-- Main Common JS -->
    <script src="{{ asset('front/theme_five/assets/js/common.js') }}"></script>
    <script src="{{ asset('front/theme_five/assets/js/index-2.js') }}"></script>
   
@endif

@if (session()->has('success'))
  <script>
    "use strict";
    toastr['success']("{{ __(session('success')) }}");
  </script>
@endif

@if (session()->has('error'))
  <script>
    "use strict";
    toastr['error']("{{ __(session('error')) }}");
  </script>
@endif


@if ($websiteInfo->theme_version == 'theme_five')
<script>
       $(window).on("scroll", function () {
        var header = $(".header-area");
        // If window scroll down .is-sticky class will added to header
        if ($(window).scrollTop() >= 100) {
            header.addClass("is-sticky");
        } else {
            header.removeClass("is-sticky");
        }
    });
</script>
@endif
