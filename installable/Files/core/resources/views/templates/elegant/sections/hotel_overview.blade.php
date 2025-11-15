@php
    $content = getContent('hotel_overview.content', true);
    $elements = getContent('hotel_overview.element', false, null, true);
@endphp

<div class="glance-section my-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <span class="section-heading__subtitle"> {{ __($content?->data_values?->heading) }} </span>
                    <h2 class="section-heading__title"> {{ __($content?->data_values?->subheading) }} </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="glance-slider">
        @foreach ($elements as $item)
            <div class="glance-item">
                <div class="glance-item__thumb">
                    <img src="{{ frontendImage('hotel_overview', $item->data_values->image, '1100x575') }}" alt="image">
                </div>
                <p class="glance-item__desc">{{ __($item->data_values->description) }}</p>
            </div>
        @endforeach
    </div>
</div>
