@extends($activeTemplate . 'layouts.app')
@section('layout')
    @php
        $content = getContent('banned_page.content', true);
    @endphp

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <img src="{{ frontendImage('banned_page', $content?->data_values?->image, '700x400') }}" alt="@lang('image')" class="img-fluid mx-auto">
                    <h2 class="text--danger">{{ __($content?->data_values?->heading) }}</h2>
                    <h6 class="mb-0">@lang('Ban Reason')</h6>
                    <p class="fw-bold"> {{ __(auth()->user()->ban_reason) }}</p>
                    <a href="{{ route('home') }}" class="btn btn--base mt-3">@lang('Go To Home')</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        body {
            background: unset !important;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
    </style>
@endpush
