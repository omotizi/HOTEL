@php
    $content = getContent('blog.content', true);
    $elements = getContent('blog.element', false, 3, true);
@endphp

<section class="my-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title"> {{ __($content?->data_values?->heading) }} </h2>
                    <p class="section-heading__desc">{{ __($content?->data_values?->subheading) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($elements as $blog)
                @include('Template::partials.blog_item')
            @endforeach
        </div>
    </div>
</section>
