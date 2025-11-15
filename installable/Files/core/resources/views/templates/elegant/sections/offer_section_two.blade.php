@php
    $content = getContent('offer_section_two.content', true);
    $offerRoomTypes = App\Models\RoomType::active()->whereActiveRoom()->whereHasOffer()->with('images')->limit(3)->get();
@endphp

<section class="offer-section style-two  mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-top mt-0">
                    <div class="section-heading style-left">
                        <h3 class="section-heading__title">{{ __($content?->data_values?->heading) }}</h3>
                        <p class="section-heading__desc">{{ __($content?->data_values?->subheading) }}</p>
                    </div>
                    <a href="{{ route('rooms') }}" class="btn btn--base">@lang('View all')<span class="icon"> <i class="las la-arrow-right"></i> </span> </a>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($offerRoomTypes as $roomType)
                <div class="col-lg-4 col-md-6">
                    <div class="offer-card">
                        <div class="offer-card__slider category-slider">
                            <div class="offer-card__slider-item">
                                <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . $roomType->main_image, getFileSize('roomTypeImage')) }}" alt="img">
                            </div>
                            @foreach ($roomType->images as $roomImage)
                                <div class="offer-card__slider-item">
                                    <img src="{{ getImage(getFilePath('roomTypeImage') . '/' . $roomImage->image, getFileSize('roomTypeImage')) }}" alt="img">
                                </div>
                            @endforeach
                        </div>
                        <div class="offer-card__content">
                            <h5 class="offer-card__title mb-0">
                                <a href="{{ route('room.type.details', $roomType->slug) }}">
                                    {{ __($roomType->name) }}
                                </a>
                            </h5>
                            <p class="offer-card__desc">
                                @php echo strLimit(strip_tags($roomType->description), 150)  @endphp
                            </p>
                            <a href="{{ route('room.type.details', $roomType->slug) }}" class="view-more-btn"> @lang('View Room')
                                <span class="icon">
                                    <i class="las la-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
