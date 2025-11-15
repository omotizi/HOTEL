@php
    $bookingAdvantageContent = getContent('booking_advantage.content', true);
    $bookingAdvantageElements = getContent('booking_advantage.element', false, null, true);
@endphp


<div class="benefit-section my-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title"> {{ __(@$bookingAdvantageContent->data_values->heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($bookingAdvantageElements as $bookingAdvantageElement)
                <div class="col-xl-3 col-6">
                    <div class="benefit-item">
                        <span class="benefit-item__icon">
                            <img src="{{ frontendImage('booking_advantage', $bookingAdvantageElement->data_values->icon) }}" alt="icon">
                        </span>
                        <p class="benefit-item__text"> {{ __(@$bookingAdvantageElement->data_values->advantage) }} </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
