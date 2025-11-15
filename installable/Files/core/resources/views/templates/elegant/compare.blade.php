@extends($activeTemplate . 'layouts.frontend', ['banner' => false])
@section('content')
    @include($activeTemplate . 'sections.banner')

    <div class="category-section">
        <div class="category-section__shape">
            <img src="{{ asset(activeTemplate(true) . 'images/shapes/ca-1.png') }}" alt="image">
        </div>
        <div class="container">
            <div class="category-wrapper">
                <h2 class="category-wrapper__title"> @lang('Comparison') </h2>
                <div class="category-wrapper__left">
                    <a href="{{ route('rooms') }}" class="back-btn"> <span class="back-btn__icon"> <i class="las la-arrow-left"></i> </span> @lang('Back to rooms & suites') </a>
                </div>
            </div>
        </div>
    </div>

    <div class="room-category-section mt-60 mb-120">
        <div class="container">

            <div class="row gy-5 compareRow">
                @if ($compareRoomTypes->count())
                    @foreach ($compareRoomTypes as $compareRoomType)
                        <div class="col-lg-4">
                            <div class="room-category-wrapper position-relative w-100 d-flex flex-column">
                                <button class="compare-remove-btn btn-lg compareRemoveBtn" data-id="{{ $compareRoomType->id }}">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                                <div class="room-category-slider category-slider">
                                    <div class="room-category-slider__item">
                                        <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . @$compareRoomType->main_image, getFileSize('roomTypeImage')) }}" alt="room">
                                    </div>
                                    @foreach ($compareRoomType->images as $roomImage)
                                        <div class="room-category-slider__item">
                                            <img src="{{ getImage(getFilePath('roomTypeImage') . '/' . @$roomImage->image, getFileSize('roomTypeImage')) }}" alt="room">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="room-category-content compare-content flex-fill d-flex flex-column">
                                    <div class="compare-content__top mb-0">
                                        <h5 class="room-category-content__title">
                                            <a href="{{ route('room.type.details', $compareRoomType->slug) }}">{{ __($compareRoomType->name) }}</a>
                                        </h5>
                                        <p class="room-desc"> @lang('Rate') <span class="fw-bold">{{ showAmount($compareRoomType->fare) }}</span> @lang('per night.')</p>
                                        @if ($compareRoomType->checkOffer())
                                            <p class="room-desc mt-0"> @lang('Discounted Rate') <span class="text--success fw-bold">{{ showAmount($compareRoomType->roomFare()) }}</span> @lang('per night.')</p>
                                        @endif
                                    </div>
                                    <div class="compare-content__item">
                                        <span class="compare-content__item-title"> @lang('Size') </span>
                                        <p class="compare-content__item-text">@lang('Size:')
                                            {{ __(@$compareRoomType->size) }}</p>
                                    </div>
                                    @if ($compareRoomType->room_suite == Status::ROOM)
                                        <div class="compare-content__item">
                                            <span class="compare-content__item-title"> @lang('Bed') </span>
                                            <p class="compare-content__item-text">
                                                @foreach ($compareRoomType->beds as $key => $bed)
                                                    {{ $key == 0 ? '' : ', ' }} <span>{{ __($bed) }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    @endif
                                    @if ($compareRoomType->room_suite == Status::SUITE)
                                        <div class="compare-content__item">
                                            <div class="d-flex align-items-center justify-content-start gap-2">
                                                <span class="compare-content__item-title"> @lang('Rooms') </span>
                                                <button class="view_room_btn" data-rooms='@json($compareRoomType->suitesTypeRooms)' data-bs-toggle="tooltip" data-bs-title="View Rooms">
                                                    <i class="las la-info-circle"></i>
                                                </button>
                                            </div>
                                            <p class="compare-content__item-text">
                                                @foreach ($compareRoomType->suitesTypeRooms->groupBy('room_type') as $key => $suiteTypeRoom)
                                                    @if (!$loop->first)
                                                        ,
                                                    @endif
                                                    <span>{{ __($key) }}({{ $suiteTypeRoom->count() }})</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    @endif

                                    <div class="compare-content__item">
                                        <span class="compare-content__item-title"> @lang('Allow Max') </span>
                                        <p class="compare-content__item-text"> @lang('Adults :')
                                            {{ @$compareRoomType->total_adult }}, @lang('Children :')
                                            {{ @$compareRoomType->total_child }} </p>
                                    </div>
                                    <div class="compare-content__item">
                                        <span class="compare-content__item-title"> @lang('Amenities') </span>
                                        <p class="compare-content__item-text">
                                            @forelse ($compareRoomType->amenities as $key => $amenity)
                                                {{ $key == 0 ? '' : ', ' }} <span>{{ __(@$amenity->title) }}</span>
                                            @empty
                                                @lang('No Amenities Available')
                                            @endforelse
                                        </p>
                                    </div>
                                    <div class="compare-content__item">
                                        <span class="compare-content__item-title"> @lang('Facilities') </span>
                                        <p class="compare-content__item-text">
                                            @forelse ($compareRoomType->facilities as $key => $facility)
                                                {{ $key == 0 ? '' : ', ' }}{{ __(@$facility->title) }}
                                            @empty
                                                @lang('No Facilities Available')
                                            @endforelse
                                        </p>
                                    </div>
                                    <a href="{{ route('room.type.details', $compareRoomType->slug) }}" class="btn room-btn w-100 mb-0 mt-auto"> @lang('View Room') <i class="las la-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <div class="text-center">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 0C10.7656 0 0 10.7656 0 24C0 37.2344 10.7656 48 24 48C37.2344 48 48 37.2344 48 24C48 10.7656 37.2344 0 24 0ZM24 4C35.0703 4 44 12.9297 44 24C44 35.0703 35.0703 44 24 44C12.9297 44 4 35.0703 4 24C4 12.9297 12.9297 4 24 4ZM15 16C13.3438 16 12 17.3438 12 19C12 20.6562 13.3438 22 15 22C16.6562 22 18 20.6562 18 19C18 17.3438 16.6562 16 15 16ZM33 16C31.3438 16 30 17.3438 30 19C30 20.6562 31.3438 22 33 22C34.6562 22 36 20.6562 36 19C36 17.3438 34.6562 16 33 16ZM14 32V36H34V32H14Z" fill="#1A1A1A" />
                            </svg>
                            <h4 class="mt-2 mb-1">@lang('No Rooms Selected.')</h4>
                            <p class="fs-20">@lang('Back to rooms & suites page.') <a href="{{ route('rooms') }}">@lang('Click here.')</a></p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($compareRoomTypes->count())
        <div aria-hidden="true" id="viewRoomsModal" aria-labelledby="existModalCenterTitle" class="modal fade" id="existModalCenter" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="existModalLongTitle">@lang('All Rooms')</h5>
                        <span aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="modal_room_main">
                            <div class="row gy-4">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--base btn-sm" data-bs-dismiss="modal" type="button">@lang('Ok')</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.view_room_btn').on('click', function() {
                let modal = $('#viewRoomsModal');
                let rooms = $(this).data('rooms');
                let html = '';

                rooms.forEach(room => {
                    let itemsHtml = room.items.map(item => `<li>${item}</li>`).join('');
                    html += `
                        <div class="col-lg-4">
                            <h6>${room.room_type}</h6>
                            <ul>
                                ${itemsHtml}
                            </ul>
                        </div>
                    `;
                });

                modal.find('.modal_room_main .row').html(html);
                modal.modal('show');
            });

            $('.compareRemoveBtn').on('click', function() {
                let self = $(this);
                let roomId = self.data('id');
                $.ajax({
                    url: "{{ route('compare') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: roomId,
                    },
                    success: function(response) {
                        if (response.message == "success") {
                            self.closest('.col-lg-4').remove();

                            if ($('.compareRow').find('.col-lg-4').length == 0) {
                                $('.compareRow').html(`
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M24 0C10.7656 0 0 10.7656 0 24C0 37.2344 10.7656 48 24 48C37.2344 48 48 37.2344 48 24C48 10.7656 37.2344 0 24 0ZM24 4C35.0703 4 44 12.9297 44 24C44 35.0703 35.0703 44 24 44C12.9297 44 4 35.0703 4 24C4 12.9297 12.9297 4 24 4ZM15 16C13.3438 16 12 17.3438 12 19C12 20.6562 13.3438 22 15 22C16.6562 22 18 20.6562 18 19C18 17.3438 16.6562 16 15 16ZM33 16C31.3438 16 30 17.3438 30 19C30 20.6562 31.3438 22 33 22C34.6562 22 36 20.6562 36 19C36 17.3438 34.6562 16 33 16ZM14 32V36H34V32H14Z"
                                                fill="#1A1A1A" />
                                        </svg>
                                        <h4 class="mt-2 mb-1">@lang('No Rooms Selected.')</h4>
                                        <p class="fs-20">@lang('Back to rooms & suites page.') <a href="{{ route('rooms') }}">@lang('Click here.')</a></p>
                                    </div>
                                `);
                            }
                        }
                    }
                })
            })

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .modal_room_main ul {
            padding-left: 20px;
        }

        .modal_room_main ul li {
            list-style: circle;
            padding-bottom: 5px;
        }

        .modal_room_main h6 {
            margin-bottom: 6px;
        }
    </style>
@endpush
