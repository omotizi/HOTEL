@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <div class="profile-setting-section">
        <div class="profile-setting-section__shape">
            <img src="{{ asset(activeTemplate(true) . 'images/shapes/ca-1.png') }}" alt="shape">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <ul class="residence-list justify-content-center" id="myTab" role="tablist">
                        <li class="residence-list__item" role="presentation">
                            <a href="{{ route('gallery') }}" class="residence-list__link {{ request()->routeIs('gallery') ? 'active' : '' }}">@lang('Galleries') </a>
                        </li>
                        <li class="residence-list__item" role="presentation">
                            <a href="{{ route('video') }}" class=" residence-list__link {{ request()->routeIs('video') ? 'active' : '' }}"> @lang('Videos') </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('Template::sections.video')

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif

@endsection

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/gallery.js') }}"></script>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";
            // video popup
            var videoItem = $(".video-item");
            if (videoItem) {
                videoItem.magnificPopup({
                    type: "iframe",
                });
            };
        })(jQuery);
    </script>
@endpush
