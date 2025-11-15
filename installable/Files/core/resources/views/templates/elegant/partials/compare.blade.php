@foreach ($roomTypes as $roomType)
    <div class="room-compare__thumb short-compare" id="{{ $roomType->id }}">
        <button class="compare-remove-btn removeFromCompareBtn" data-id="{{ $roomType->id }}">
            <i class="fa-solid fa-times"></i>
        </button>
        <img src="{{ getImage(getFilePath('roomTypeImage') . '/thumb_' . $roomType->main_image, getFileSize('roomTypeImage')) }}"
            alt="room">
    </div>
@endforeach
