@extends($activeTemplate . 'layouts.frontend', ['banner' => false])
@section('content')
    @include($activeTemplate . 'partials.banner', ['type' => 'blog','size'=>'1920x570'])

    <section class="my-120">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @foreach ($blogs as $blog)
                    @include('Template::partials.blog_item')
                @endforeach
            </div>

            @if ($blogs->hasPages())
                <div class="mt-5">
                    {{ paginateLinks($blogs) }}
                </div>
            @endif
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
