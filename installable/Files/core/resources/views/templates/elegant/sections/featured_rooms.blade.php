@php
    $content = getContent('featured_rooms.content', true);
    $allFeatureRoomType = App\Models\RoomType::active()->featured();
    $featureRoomType = (clone $allFeatureRoomType)->get();
    $roomFeatureRoomType = (clone $allFeatureRoomType)->room()->get();
    $suiteFeatureRoomType = (clone $allFeatureRoomType)->suite()->get();
@endphp

<div class="residence-section mb-60 mt-120">
    <div class="container">
        <div class="row justify-content-lg-between gy-3">
            <div class="col-lg-12">
                <div class="section-heading style-left">
                    <div>
                        <h2 class="section-heading__title"> {{ __($content?->data_values?->heading) }} </h2>
                        <p class="section-heading__desc">{{ __($content?->data_values?->subheading) }} </p>
                    </div>

                    <ul class="residence-list" id="tabMenuList" role="tablist">
                        <li class="residence-list__item" role="presentation">
                            <button class="residence-list__link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true">
                                @lang('All')
                            </button>
                        </li>
                        <li class="residence-list__item" role="presentation">
                            <button class="residence-list__link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#rooms-tab-pane" type="button" role="tab" aria-controls="rooms-tab-pane" aria-selected="false">
                                @lang('Rooms')
                            </button>
                        </li>
                        <li class="residence-list__item" role="presentation">
                            <button class="residence-list__link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#suites-tab-pane" type="button" role="tab" aria-controls="suites-tab-pane" aria-selected="false">
                                @lang('Suites')
                            </button>
                        </li>
                        <li class="residence-list__item" role="presentation">
                            <a href="{{ route('rooms') }}" class="residence-list__link">
                                @lang('View all')
                                <span class="residence-list__icon"><i class="las la-arrow-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content" id="allTab">
        <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="residence-slider">
                @foreach ($featureRoomType as $roomType)
                    <div class="residence-item">
                        <div class="residence-item__thumb">
                            <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$roomType->main_image, getFileSize('roomTypeImage')) }}" alt="room">
                        </div>
                        <div class="residence-item__content">
                            <h4 class="residence-item__title">
                                <a href="{{ route('room.type.details', $roomType->slug) }}" class="residence-item__title-link"> {{ __($roomType->name) }} </a>
                            </h4>
                            <p class="residence-item__desc">
                                @php echo strLimit(strip_tags($roomType->description), 150)  @endphp
                            </p>
                            <div class="residence-item__btn">
                                <a href="{{ route('room.type.details', $roomType->slug) }}" class="residence-item__btn-link">
                                    @lang('View all') <span class="icon"> <i class="las la-arrow-right"></i> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="rooms-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="residence-slider">
                @foreach ($featureRoomType as $roomType)
                    <div class="residence-item">
                        <div class="residence-item__thumb">
                            <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$roomType->main_image, getThumbSize('roomTypeImage')) }}" alt="room">
                        </div>
                        <div class="residence-item__content">
                            <h4 class="residence-item__title">
                                <a href="{{ route('room.type.details', $roomType->slug) }}" class="residence-item__title-link"> {{ __($roomType->name) }} </a>
                            </h4>
                            <p class="residence-item__desc">
                                @php echo strLimit(strip_tags($roomType->description), 150)  @endphp
                            </p>
                            <div class="residence-item__btn">
                                <a href="{{ route('room.type.details', $roomType->slug) }}" class="residence-item__btn-link">
                                    @lang('View all') <span class="icon"> <i class="las la-arrow-right"></i> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="suites-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <div class="residence-slider">
                @foreach ($featureRoomType as $roomType)
                    <div class="residence-item">
                        <div class="residence-item__thumb">
                            <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$roomType->main_image, getFileSize('roomTypeImage')) }}" alt="room">
                        </div>
                        <div class="residence-item__content">
                            <h4 class="residence-item__title">
                                <a href="{{ route('room.type.details', $roomType->slug) }}" class="residence-item__title-link"> {{ __($roomType->name) }} </a>
                            </h4>
                            <p class="residence-item__desc">
                                @php echo strLimit(strip_tags($roomType->description), 150)  @endphp
                            </p>
                            <div class="residence-item__btn">
                                <a href="{{ route('room.type.details', $roomType->slug) }}" class="residence-item__btn-link">
                                    @lang('View all') <span class="icon"> <i class="las la-arrow-right"></i> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function($) {
            'use strict';

            $('#tabMenuList .residence-list__link').on('click', function() {
                var target = $(this).data('bs-target');
                var $slider = $(target).find('.residence-slider');
                $slider.slick('refresh');
            });
        })(jQuery);
    </script>
@endpush
