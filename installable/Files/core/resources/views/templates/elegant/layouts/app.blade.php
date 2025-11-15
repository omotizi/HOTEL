<!-- meta tags and other links -->
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="{{ config('app.locale') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <title> {{ gs()->siteName(__($pageTitle)) }}</title>

    @include('partials.seo')

    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/global/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/popup.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}">

    @stack('style-lib')

    @stack('style')

    <link href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ gs('base_color') }}" rel="stylesheet">
</head>
@php echo loadExtension('google-analytics') @endphp

<body>
    @stack('fbComment')

    <div class="loader">
        <div class="loader-wrapper">
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
            <div class="loader-wrapper__box"></div>
        </div>
    </div>

    <div class="body-overlay"></div>
    <div class="sidebar-overlay"></div>
    <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

    @yield('layout')

    @php
        $myCart = App\Models\Cart::myCart()->get();
        $totalAmount = 0;
        $totalRoom = 0;
        if ($myCart->count()) {
            $totalAmount = $myCart->sum('total_fare');
            $totalRoom = $myCart->sum('quantity');
        }
    @endphp

    @if (!Route::is('checkout'))
        <div class="selection-widget @if (!$myCart->count()) widget-hide @endif">
            <a href="{{ route('checkout') }}" class="link">
                <h6 class="mb-0">@lang('Fare')</h6>
                <span class="amount">{{ showAmount($totalAmount) }}</span>
                <small><span class="fw-bold total_rooms">{{ $totalRoom }}</span> @lang('rooms selected')</small>
            </a>
        </div>
    @endif

    <!-- jQuery library -->
    <script src="{{ asset('assets/global/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/global/js/slick.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/swiper.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/select2.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/popup.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>

    @stack('script-lib')

    @php echo loadExtension('tawk-chat') @endphp

    @include('partials.notify')

    @if (gs('pn'))
        @include('partials.push_script')
    @endif

    @stack('script')

    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });

            var inputElements = $('[type=text],[type=email],[type=number],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });


            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });


            let disableSubmission = false;
            $('.disableSubmission').on('submit', function(e) {
                if (disableSubmission) {
                    e.preventDefault()
                } else {
                    disableSubmission = true;
                }
            });

        })(jQuery);
    </script>
</body>

</html>
