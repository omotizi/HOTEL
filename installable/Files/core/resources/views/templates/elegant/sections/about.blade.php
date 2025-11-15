@php
    $content = getContent('about.content', true);
    $aboutElements = getContent('about.element', false, null, true);
@endphp

<div class="story-section">
    <div class="story-section__shape">
        <img src="{{ getImage($activeTemplateTrue . 'images/backgrounds/about.png', '1905x560') }}" alt="background">
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-between  flex-wrap-reverse">
            <div class="col-xl-6 col-lg-7 pe-lg-5 d-none d-lg-block">
                <div class="story-left">
                    <div class="story-left__shape">
                        <img src="{{ getImage($activeTemplateTrue . 'images/backgrounds/about-shape-white.png') }}"
                            alt="background">
                    </div>
                    <div class="story-slider">
                        @foreach ($aboutElements as $aboutElement)
                            <div class="story-item">
                                <img src="{{ frontendImage('about', $aboutElement->data_values?->image, '380x520') }}"
                                    alt="image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5">
                <div class="story-content">
                    <span class="story-content__subtitle"> {{ __($content?->data_values?->heading) }}</span>
                    <h2 class="story-content__title"> {{ __($content?->data_values?->subheading) }} </h2>
                    <div>
                        @php echo trans($content?->data_values?->description) @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
