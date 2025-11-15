@php
    $sessionData = session('search_data');
    $checkin = isset($sessionData['check_in']) ? $sessionData['check_in'] : now()->format('Y-m-d');
    $checkout = isset($sessionData['check_out']) ? $sessionData['check_out'] : now()->addDay()->format('Y-m-d');
@endphp

@foreach ($roomTypes as $type)
    @php
        $availableRooms = countAvailableRooms($type, $checkin, $checkout);
    @endphp
    <div class="{{ $class }}">
        <div class="room-card">
            <div class="room-card__thumb">
                <img alt="image" src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . $type->main_image, getFileSize('roomTypeImage')) }}">
            </div>
            <div class="room-card__content">
                <div class="room-card__top">
                    <div class="left">
                        <h3 class="title mb-2"><a href="{{ route('room.type.details', $type->slug) }}">{{ __($type->name) }}</a></h3>
                        <small class="text--muted d-block">
                            @lang('Capacity:') {{ $type->total_adult . ' ' . str()->plural('Adult', $type->total_adult) }} @if ($type->total_child > 0)
                                @lang('and') {{ $type->total_child . ' ' . str()->plural('Adult', $type->total_child) }}
                            @endif
                        </small>
                        <small class="text--muted ">
                            @lang('Available Rooms'): {{ $availableRooms }}
                        </small>
                    </div>
                    <div class="right">
                        <span class="old-price">
                            <del>{{ showAmount($type->fare) }}</del>
                        </span>
                        <h6 class="price">
                            <span class="fare">{{ showAmount($type->roomFare()) }}</span> <span class="text"> / @lang('Night') </span>
                        </h6>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="form--label"> @lang('Number of Rooms')</label>
                    <div class="room-card__bottom d-flex justify-content-between align-items-center gap-2">
                        <div class="qty-container">
                            <button class="qty-btn-minus btn-light disabled" type="button"><i class="fa fa-minus"></i></button>
                            <input type="text" name="number_of_rooms[]" value="1" class="input-qty numberOfRoom" readonly/>
                            <button class="qty-btn-plus btn-light @if ($availableRooms == 1) disabled @endif" data-max="{{ $availableRooms }}" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                        <button type="button" class="btn btn--base btn-md addBtn" data-room_type_id="{{ $type->id }}"> @lang('Book') </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.qty-btn-plus').on('click', function() {
                let max = $(this).data('max');
                let inputField = $(this).parents('.room-card__bottom').find('.numberOfRoom');
                let value = Number(inputField.val()) + 1;

                if (value <= max) {
                    inputField.val(value);
                    $(this).parents('.room-card__bottom').find('.qty-btn-minus').removeClass('disabled');
                    if (value == max) $(this).addClass('disabled');
                }
            });

            $('.qty-btn-minus').on('click', function() {
                let inputField = $(this).parents('.room-card__bottom').find('.numberOfRoom');
                let value = Number(inputField.val()) - 1;

                if (value >= 1) {
                    inputField.val(value);
                    $(this).parents('.room-card__bottom').find('.qty-btn-plus').removeClass('disabled');
                    if (value == 1) $(this).addClass('disabled');
                }
            });

            $('.addBtn').on('click', function() {
                let roomTypeId = $(this).data('room_type_id');
                let numberOfRooms = $(this).parents('.room-card').find('.numberOfRoom').val();
                let totalAdult = $('[name=total_adult]').val();
                let totalChildren = $('[name=total_child]').val();

                let checkIn = $('[name=check_in]').val();
                let checkout = $('[name=check_out]').val();

                const url = "{{ route('room.select') }}";
                let data = {
                    _token: `{{ csrf_token() }}`,
                    room_type_id: roomTypeId,
                    check_in: checkIn,
                    check_out: checkout,
                    number_of_rooms: numberOfRooms,
                    adult: totalAdult,
                    children: totalChildren
                };

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(response) {
                        if (response.status) {
                            notify('success', response.message);
                            let widget = $('.selection-widget');
                            widget.find('.amount').text(response.data.total_amount);
                            widget.find('.total_rooms').text(response.data.total_rooms);
                            widget.removeClass('widget-hide');
                        } else {
                            notify('error', response.errors);
                        }
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
