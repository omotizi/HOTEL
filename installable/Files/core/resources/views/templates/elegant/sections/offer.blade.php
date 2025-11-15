@php
    $content = getContent('offer.content', true);
    $offerRoomTypes = App\Models\RoomType::active()
        ->whereActiveRoom()
        ->whereHasOffer()
        ->with('images')
        ->limit(8)
        ->get();
@endphp

@if (!blank($offerRoomTypes))
    <section class="offer-section py-60 my-120 section-bg-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <span class="section-heading__subtitle"> {{ __($content?->data_values?->heading) }} </span>
                        <h2 class="section-heading__title"> {{ __($content?->data_values?->subheading) }} </h2>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                @foreach ($offerRoomTypes as $roomType)
                    <div class="col-xl-3 col-md-6">
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
                                <span class="mb-2 text--base"> {{ ucFirst(__($roomType->getRoomOrSuite(true))) }} </span>
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
@endif
