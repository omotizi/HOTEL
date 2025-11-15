@php
    $content = getContent('testimonial.content', true);
    $elements = getContent('testimonial.element', false);
@endphp

<section class="testimonials bg-img py-60" data-background-image="{{ frontendImage('testimonial', $content?->data_values?->background_image, '1920x560') }}">
    <div class="container">
        <div class="testimonial-slider">
            @foreach ($elements as $item)
                <div class="testimonials-card">
                    <div class="testimonial-item">
                        <div class="testimonial-item__content">
                            <div class="testimonial-item__info">
                                <p class="testimonial-item__desc testimonial-icon text--base pb-2">
                                    <i class="fa-solid fa-quote-right"></i>
                                </p>
                                <p class="testimonial-item__desc"> {{ __($item->data_values->feedback) }} </p>
                                <div class="testimonial-item__user flex-center gap-2">
                                    <div class="testimonial-item__thumb flex-shrink-0">
                                        <img src="{{ frontendImage('testimonial', $item->data_values->image, '100x100') }}" class="fit-image" alt="testimonial">
                                    </div>
                                    <div class="testimonial-item__details flex-fill">
                                        <p class="testimonial-item__name"> {{ __($item->data_values->name) }} </p>
                                        <p class="testimonial-item__booked fw-normal">
                                            @for ($i = 1; $i <= $item->data_values->rating; $i++)
                                                <i class="fas fa-star text--warning"></i>
                                            @endfor
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
