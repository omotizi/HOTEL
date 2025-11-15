@php
    $content = getContent('facility.content', true);
    $elements = getContent('facility.element');
@endphp
<div class="facility-section my-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title"> {{ __($content?->data_values?->heading) }} </h2>
                    <p class="section-heading__desc"> {{ __($content?->data_values?->subheading) }} </p>
                </div>
            </div>
        </div>
        <div class="facility-slider">
            @foreach ($elements as $item)
            <div class="facility-item">
                <div class="facility-item__thumb">
                    <img src="{{ frontendImage('facility', $item->data_values->image, '630x570') }}" alt="">
                </div>
                <div class="facility-item__content">
                    <h5 class="facility-item__title">{{ __($item->data_values->title) }}</h5>
                    <p class="facility-item__desc">{{ __($item->data_values->description) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
