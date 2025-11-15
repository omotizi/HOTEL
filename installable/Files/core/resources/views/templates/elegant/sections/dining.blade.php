@php
    $content = getContent('dining.content', true);
@endphp

<div class="dining-section">
    <div class="dining-section__shape">
        <img src="{{ getImage($activeTemplateTrue. 'images/backgrounds/dining.png') }}" alt="section background">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h3 class="section-heading__title text--base"> {{__($content?->data_values?->heading)}} </h3>
                    <p class="section-heading__desc desc-two">
                        {{ __($content?->data_values?->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="dining-thumb">
            <img src="{{ frontendImage('dining', $content?->data_values?->image,'1300x540') }}" alt="client">
        </div>
    </div>
</div>
