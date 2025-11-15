@php
    $sessionData = session('search_data');
    $checkin = isset($sessionData['check_in']) ? $sessionData['check_in'] : now()->format('Y-m-d');
    $checkout = isset($sessionData['check_out']) ? $sessionData['check_out'] : now()->addDay()->format('Y-m-d');
@endphp

@foreach ($roomType as $type)
    <div class="{{ $class }}">

        <div class="room-card">
            <div class="room-card__thumb">
                <img alt="image" src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . $type->main_image, getFileSize('roomTypeImage')) }}">
            </div>
            <div class="room-card__content">
                <div class="room-card__top">
                    <div class="left">
                        <h3 class="title"><a href="{{ route('room.type.details', $type->slug) }}">{{ __($type->name) }}</a>
                        </h3>
                        <small class="text--muted d-block">
                            @lang('Capacity:') {{ $type->total_adult . ' ' . str()->plural('Adult', $type->total_adult) }} @if ($type->total_child > 0)
                                @lang('and') {{ $type->total_child . ' ' . str()->plural('Adult', $type->total_child) }}
                            @endif
                        </small>
                    </div>
                    <div class="right">
                        <h6 class="price">
                            {{ showAmount($type->roomFare()) }} <span class="text"> / @lang('Night') </span>
                        </h6>
                    </div>
                </div>
                <div class="room-card__bottom mt-3 d-block">
                    <div class="room-card__desc">
                        @php echo strLimit(strip_tags($type->description), 130)  @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
