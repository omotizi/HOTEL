@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.hotel.room.type.save', @$roomType ? $roomType->id : 0) }}" enctype="multipart/form-data" method="POST" class="disableSubmission">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('General Information')
                        </h5>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" name="name" required type="text" value="{{ old('name', @$roomType->name) }}">
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                                        <label>@lang('Slug')</label>
                                        <div>
                                            <span class="text--small me-1 slug-verification d-none"></span>
                                            <span class="text--small cursor-pointer fst-italic text--info buildSlug"> <i class="las la-link"></i> @lang('Make Slug')</span>
                                        </div>
                                    </div>
                                    <input class="form-control" name="slug" required type="text" value="{{ old('name', @$roomType->slug) }}">
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group position-relative">
                                    <label> @lang('Room/Suite')</label>
                                    <select name="room_suite" class="select2" data-minimum-results-for-search="-1" required>
                                        <option value="">@lang('Select One')</option>
                                        <option value="1" @selected(old('room_suite', @$roomType->room_suite) == 1)>@lang('Room')</option>
                                        <option value="2" @selected(old('room_suite', @$roomType->room_suite) == 2)>@lang('Suite')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label class="required" for="fare">@lang('Fare') /@lang('Night')</label>
                                    <div class="input-group">
                                        <input class="form-control" id="fare" name="fare" required type="number" value="{{ old('fare', @$roomType->fare ? getAmount(@$roomType->fare) : '') }}">
                                        <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="offer_fare">@lang('Offer Fare') /@lang('Night')</label>
                                    <div class="input-group">
                                        <input class="form-control" name="offer_fare" type="number" value="{{ old('offer_fare', @$roomType->offer_fare ? getAmount(@$roomType->offer_fare) : '') }}">
                                        <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Cancellation Fee') /@lang('Night')</label>
                                    <div class="input-group">
                                        <input class="form-control cancellationFee" min="0" name="cancellation_fee" required step="any" type="number" value="{{ old('cancellation_fee', @$roomType->cancellation_fee ? getAmount(@$roomType->cancellation_fee) : '') }}">
                                        <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Total Adult')</label>
                                    <input class="form-control" min="1" name="total_adult" required type="number" value="{{ old('total_adult', @$roomType->total_adult) }}">
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Total Child')</label>
                                    <input class="form-control" min="0" name="total_child" required type="number" value="{{ old('total_child', @$roomType->total_child) }}">
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Size')</label>
                                    <input class="form-control" name="size" required type="text" value="{{ old('size', @$roomType->size) }}">
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <div class="form-group position-relative">
                                    <label> @lang('Amenities')</label>
                                    <select class="select2-multi-select" multiple="multiple" name="amenities[]">
                                        @foreach ($amenities as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <div class="form-group position-relative">
                                    <label> @lang('Facilities')</label>
                                    <select class="select2-multi-select" multiple="multiple" name="facilities[]">
                                        @foreach ($facilities as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <div class="form-group position-relative">
                                    <label>@lang('Keywords')</label>
                                    <select class="form-control select2-auto-tokenize" multiple="multiple" name="keywords[]"></select>
                                    <small class="ml-2 mt-2">@lang('Separate multiple keywords by') <code>,</code>(@lang('comma'))
                                        @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <div class="form-group">
                                    <label> @lang('Featured') </label>
                                    <input @if (@$roomType->is_featured) checked @endif data-bs-toggle="toggle" data-height="50" data-off="@lang('Unfeatured')" data-offstyle="-danger" data-on="@lang('Featured')" data-onstyle="-success" data-size="large" data-width="100%" name="is_featured" type="checkbox">
                                    <small class="ml-2 mt-2"><code><i class="las la-info-circle"></i>
                                            @lang('Featured rooms will be displayed in featured rooms section.')</code></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3 roomTypeRooms d-none">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('Bed Per Room')
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center mb-3">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h4 class="mb-1">@lang('Total Bed')</h4>
                                    <input @isset($roomType) readonly @endisset class="form-control" min="1" name="total_bed" required type="number" value="{{ @$roomType ? count(@$roomType->beds) : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="bed">
                            @isset($roomType)
                                <div class="row border-top pt-3">
                                    @foreach ($roomType->beds as $bed)
                                        <div class="col-md-3 number-field-wrapper bed-content">
                                            <div class="form-group">
                                                <label class="required" for="bed">@lang('Bed') - <span class="serialNumber">{{ $loop->iteration }}</span></label>
                                                <div class="input-group">
                                                    <select class="form-control bedType" name="bed[{{ $loop->iteration }}]" required>
                                                        <option value="">@lang('Select One')</option>
                                                        @foreach ($bedTypes as $bedType)
                                                            <option @if ($bedType->name == $bed) selected @endif value="{{ $bedType->name }}">
                                                                {{ $bedType->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button class="input-group-text bg-danger btnRemove border-0" data-name="bed" type="button"><i class="las la-times"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn--success addMore" type="button"> <i class="la la-plus"></i>@lang('Add More')</button>
                            @endisset
                        </div>
                    </div>
                </div>

                <div class="row gy-3 mt-0 suiteTypeRooms d-none">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        @lang('Rooms')
                                    </h5>
                                    <button type="button" class="btn btn-primary add__room"><i class="las la-plus"></i> @lang('Add Room')</button>
                                </div>
                            </div>
                            <div class="card-body room__card">
                                <div class="row gy-4">
                                    @if (!@$roomType)
                                        <div class="room__main col-12 col-lg-6 col-xl-4" id="room_no_1">
                                            <div class="card border">
                                                <button type="button" class="btn btn--danger removeCard" disabled><i class="fa-solid fa-xmark"></i></button>
                                                <div class="card-body">
                                                    <div class="form-group position-relative mb-4">
                                                        <label>@lang('Room Type')</label>
                                                        <select class="form-control select2-auto-tokenize" name="room[0]" required>
                                                            <option value="Bedroom">@lang('Bedroom')</option>
                                                            <option value="Washroom">@lang('Washroom')</option>
                                                            <option value="Kitchen Room">@lang('Kitchen Room')</option>
                                                            <option value="Dining Room">@lang('Dining Room')</option>
                                                        </select>
                                                        <small class="ml-2 mt-2 text--small text--info"> <i class="fas fa-info-circle"></i> @lang('Type into the search field and press "Enter" to add new option.')</small>
                                                    </div>
                                                    <div class="items__box_main">
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <label class="required">@lang('Room Items')</label>
                                                            <button type="button" class="btn btn-sm btn--success addItemBtn" data-room-id="1"><i class="las la-plus"></i>@lang('Add Item')</button>
                                                        </div>
                                                        <div class="items__box">
                                                            <div class="input-group mb-2">
                                                                <input type="text" name="item[0]" class="form-control" placeholder="@lang('Enter item name')" required>
                                                                <button type="button" class="input-group-text btn btn--danger removeItems" disabled><i class="las la-times me-0"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($roomType->suitesTypeRooms as $suitesTypeRoom)
                                            <div class="room__main col-12 col-lg-6 col-xl-4" id="room_no_{{ $suitesTypeRoom->id }}">
                                                <div class="card border">
                                                    <button type="button" class="btn btn--danger removeCard"><i class="fa-solid fa-xmark"></i></button>
                                                    <div class="card-body">
                                                        <div class="form-group position-relative mb-4">
                                                            <label>@lang('Room Type')</label>
                                                            <select class="form-control select2-auto-tokenize" name="room[{{ $suitesTypeRoom->id }}]" required>
                                                                <option value="Bedroom" @selected($suitesTypeRoom->room_type == 'Bedroom')>@lang('Bedroom')</option>
                                                                <option value="Washroom" @selected($suitesTypeRoom->room_type == 'Washroom')>@lang('Washroom')</option>
                                                                <option value="kitchen Room" @selected($suitesTypeRoom->room_type == 'kitchen Room')>@lang('Kitchen Room')</option>
                                                                <option value="Dining Room" @selected($suitesTypeRoom->room_type == 'Dining Room')>@lang('Dining Room')</option>
                                                                @if (!in_array($suitesTypeRoom->room_type, ['Bedroom', 'Washroom', 'kitchen Room', 'Dining Room']))
                                                                    <option value="{{ $suitesTypeRoom->room_type }}" @selected(true)>{{ __($suitesTypeRoom->room_type) }}</option>
                                                                @endif
                                                            </select>
                                                            <small class="ml-2 mt-2 text--small text--info"> <i class="fas fa-info-circle"></i> @lang('Type into the search field and press "Enter" to add new option.')</small>
                                                        </div>
                                                        <div class="items__box_main">
                                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                                <label class="required">@lang('Room Items')</label>
                                                                <button type="button" class="btn btn-sm btn--success addItemBtn" data-room-id="{{ $suitesTypeRoom->id }}"><i class="las la-plus"></i>@lang('Add Item')</button>
                                                            </div>
                                                            <div class="items__box">
                                                                @foreach ($suitesTypeRoom->items as $item)
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" name="item[{{ $suitesTypeRoom->id }}][]" class="form-control" value="{{ $item }}" placeholder="@lang('Enter item name')" required>
                                                                        <button type="button" class="input-group-text btn btn--danger removeItems"><i class="las la-times me-0"></i></button>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-3 mt-0">
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    @lang('Main Image')
                                </h5>
                            </div>
                            <div class="card-body">
                                <x-image-uploader name="main_image" class="w-100" type="roomTypeImage" :image="@$roomType->main_image" :required="@$roomType ? false : true" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    @lang('Description')
                                </h5>
                            </div>
                            <div class="card-body">
                                <textarea class="nicEdit" id="description" name="description" rows="13">@php echo @$roomType->description ?? old('description') @endphp</textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('Images')
                        </h5>

                        <small class="text--info text--small"><i class="las la-info-circle"></i> @lang('Each image will be resized into')
                            {{ getFileSize('roomTypeImage') }}@lang('px')</small>
                    </div>
                    <div class="card-body">
                        <div class="input-images pb-3"></div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            @lang('Cancellation Policy')
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="nicEdit" name="cancellation_policy" rows="6">@php echo old('cancellation_policy', @$roomType->cancellation_policy) @endphp</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @can('admin.hotel.room.type.save')
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </form>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    @if (@$roomType)
        <a href="{{ route('room.type.details', $roomType->slug) }}" class="btn btn-sm btn-outline--dark" target="_blank"><i class="las la-eye"></i>@lang('Quick View')</a>
    @endif
    @can('admin.hotel.room.type.all')
        <x-back route="{{ route('admin.hotel.room.type.all') }}" />
    @endcan
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/image-uploader.min.js') }}"></script>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/admin/css/image-uploader.min.css') }}" rel="stylesheet">
@endpush

@push('style')
    <style>
        .cursor-pointer {
            cursor: pointer;
            user-select: none;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            let bedTypes = @json($bedTypes);


            @if (isset($images))
                let preloaded = @json($images);
            @else
                let preloaded = [];
            @endif

            $('.input-images').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'images',
                preloadedInputName: 'old',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 10
            });

            initSelect2MultiSelect();
            initSelect2AutoTokenize();


            // room js
            $('[name=total_room]').on('input', function() {
                var totalRoom = $(this).val();
                if (totalRoom) {
                    let content = '<div class="row border-top pt-3">';
                    for (var i = 1; i <= totalRoom; i++) {
                        content += getRoomContent(i);
                    }
                    content += '</div>';
                    $('.room').html(content);
                }
            });

            function getRoomContent(number) {
                return `
                <div class="col-md-3 number-field-wrapper room-content">
                    <div class="form-group">
                        <label for="room" class="required">@lang('Room') - <span class="serialNumber">${number}</span></label>
                        <div class="input-group">
                            <input type="text" name="room[]" class="form-control roomNumber" required>
                            <button type="button" class="input-group-text bg-danger border-0 btnRemove" data-name="room"><i class="las la-times"></i></button>
                        </div>
                    </div>
                </div>`;
            }


            function setTotalRoom() {
                var totalRoom = $('.roomNumber').length;
                $('[name=total_room]').val(totalRoom);
            }

            //bed js
            $('[name=total_bed]').on('input', function() {
                var totalBed = $(this).val();
                if (totalBed) {
                    let content = '<div class="row border-top pt-3">';
                    for (var i = 1; i <= totalBed; i++) {
                        content += getBedContent(i);
                    }
                    content += '</div>';
                    $('.bed').html(content);
                }
            });

            function getBedContent(number) {
                return `
                    <div class="col-md-3 number-field-wrapper bed-content">
                        <div class="form-group">
                            <label for="bed" class="required">@lang('Bed') - <span class="serialNumber">${number}</span></label>
                            <div class="input-group"><select class="form-control bedType" name="bed[${number}]">
                                        <option value="">@lang('Name')</option>
                                        ${allBedType()}
                                    </select><button type="button" class="input-group-text bg-danger border-0 btnRemove" data-name="bed"><i class="las la-times"></i></button>
                            </div>
                        </div>
                    </div>`;
            }

            function setTotalBed() {
                var totalBed = $('.bedType').length;
                $('[name=total_bed]').val(totalBed);
            }

            function allBedType() {
                var options;
                $.each(bedTypes, function(i, e) {
                    options += `<option value="${e.name}">${e.name}</option>`;
                });
                return options;
            }


            //common js
            $('[name=total_bed]').on('input', function() {
                var totalBed = $(this).val();
                if (totalBed) {
                    let content = '<div class="row border-top pt-3">';
                    for (var i = 1; i <= totalBed; i++) {
                        content += getBedContent(i);
                    }
                    content += '</div>';
                    $('.bed').html(content);
                }
            });

            $(document).on('click', '.btnRemove', function() {
                $(this).closest('.number-field-wrapper').remove();
                let divName = null;
                if ($(this).data('name') == 'bed') {
                    setTotalBed();
                    divName = $('.bed-content').find('.serialNumber');
                } else {
                    divName = $('.room-content').find('.serialNumber');
                    setTotalRoom();
                }
                resetSerialNumber(divName);
            });

            function resetSerialNumber(divName) {
                $.each(divName, function(i, e) {
                    $(e).text(i + 1)
                });
            }

            $('.addMore').on('click', function() {
                if ($(this).parents().hasClass('room')) {
                    var total = $('.roomNumber').length;
                    total += 1;

                    $('.room .row').append(getRoomContent(total));
                    setTotalRoom();
                    return;
                }

                var total = $('.bedType').length;
                total += 1;

                $('.bed .row').append(getBedContent(total));
                setTotalBed();
            });

            // Edit part
            let roomType = @json(@$roomType);

            if (roomType) {
                $.each(roomType.amenities, function(i, e) {
                    $(`select[name="amenities[]"] option[value=${e.id}]`).prop('selected', true);
                });

                $.each(roomType.facilities, function(i, e) {
                    $(`select[name="facilities[]"] option[value=${e.id}]`).prop('selected', true);
                });

                initSelect2MultiSelect();

                var keyword = $('select[name="keywords[]"]');
                keyword.html('');

                let options = '';

                $.each(roomType.keywords, function(index, value) {
                    options += `<option value="${value}" selected>${value}</option>`
                });



                keyword.append(options);
                initSelect2AutoTokenize(keyword);
            }

            var dropdownParent;

            function initSelect2MultiSelect(selector = null) {

                if (selector) {
                    dropdownParent = $(selector).parents('.form-group');


                    $(selector).select2({
                        dropdownParent: dropdownParent
                    });
                } else {
                    $.each($('.select2-multi-select'), function(indexInArray, selector) {
                        dropdownParent = $(selector).parents('.form-group');
                        $(selector).select2({
                            dropdownParent: dropdownParent
                        });
                    });
                }
            }

            function initSelect2AutoTokenize(selector = null) {

                if (selector) {
                    dropdownParent = $(selector).parents('.form-group');
                    $(selector).select2({
                        dropdownParent: dropdownParent,
                    });
                } else {
                    $.each($('.select2-auto-tokenize'), function(indexInArray, selector) {
                        dropdownParent = $(selector).parents('.form-group');
                        $(selector).select2({
                            dropdownParent: dropdownParent,
                            tags: true,
                            tokenSeparators: [',']
                        });
                    });
                }
            }

            $('.buildSlug').on('click', function() {
                let slugKey = "{{ @$roomType->slug ?? '' }}";
                let closestForm = $(this).closest('form');
                let title = closestForm.find(`[name=name]`).val();
                closestForm.find('[name=slug]').val(title);
                closestForm.find('[name=slug]').trigger('input');
            });



            $('[name=slug]').on('input', function() {
                let closestForm = $(this).closest('form');
                closestForm.find('[type=submit]').addClass('disabled');

                let slug = $(this).val();

                slug = slug.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $(this).val(slug);

                if (slug) {
                    closestForm.find('.slug-verification').removeClass('d-none');
                    closestForm.find('.slug-verification').html(`
                            <small class="text--info"><i class="las la-spinner la-spin"></i> @lang('Slug')</small>
                        `);
                    $.get("{{ route('admin.hotel.room.type.check.slug') }}", {
                        slug: slug,
                        id: @json(@$roomType->id ?? 0)
                    }, function(response) {
                        if (!response.exists) {
                            closestForm.find('.slug-verification').html(`
                                    <small class="text--success"><i class="las la-check"></i> @lang('Make Slug')</small>
                                `);
                            closestForm.find('[type=submit]').removeClass('disabled')
                        }
                        if (response.exists) {
                            closestForm.find('.slug-verification').html(`
                                    <small class="text--danger"><i class="las la-times"></i> @lang('Room/Suite')</small>
                                `);
                        }
                    });
                } else {
                    closestForm.find('.slug-verification').addClass('d-none');
                }
            });


            let roomId = `{{ @$suitesType ? @$suitesType->suitesTypeRooms->last()->id : 0 }}`;

            $('.add__room').on('click', function() {
                roomId = parseInt(roomId) + 1;

                $('.room__card .row').append(`
                    <div class="room__main col-12 col-lg-6 col-xl-4" id="room_no_${roomId}">
                        <div class="card border">
                            <button type="button" class="btn btn--danger removeCard" disabled><i class="fa-solid fa-xmark"></i></button>
                            <div class="card-body">
                                <div class="form-group position-relative mb-4">
                                    <label>@lang('Room Type')</label>
                                    <select class="form-control select2-auto-tokenize" name="room[${roomId}]" required>
                                        <option value="Bedroom">@lang('Bedroom')</option>
                                        <option value="Washroom">@lang('Washroom')</option>
                                        <option value="Kitchen Room">@lang('Kitchen Room')</option>
                                        <option value="Dining Room">@lang('Dining Room')</option>
                                    </select>
                                    <small class="ml-2 mt-2 text--small text--info"> <i class="fas fa-info-circle"></i> @lang('Type into the search field and press "Enter" to add new option.')</small>
                                </div>
                                <div class="items__box_main">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <label class="required">@lang('Room Items')</label>
                                        <button type="button" class="btn btn-sm btn--success addItemBtn" data-room-id="${roomId}"><i class="las la-plus"></i>@lang('Add Item')</button>
                                    </div>
                                    <div class="items__box">
                                        <div class="input-group mb-2">
                                            <input type="text" name="item[${roomId}][]" class="form-control" placeholder="@lang('Enter item name')" required>
                                            <button type="button" class="input-group-text btn btn--danger removeItems" disabled><i class="las la-times me-0"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                );

                let roomCount = $('.room__card .row').children().length;
                if (roomCount > 1) {
                    $('.removeCard').removeAttr('disabled');
                }
                initSelect2AutoTokenize();
            });

            $(document).on('click', '.addItemBtn', function() {
                $(this).closest('.items__box_main').find('.items__box').append(`
                    <div class="input-group mb-2">
                        <input type="text" name="item[${roomId}][]" class="form-control" placeholder="@lang('Enter item name')" required>
                        <button type="button" class="input-group-text btn btn--danger removeItems"><i class="las la-times me-0"></i></button>
                    </div>
                `);

                let totalItems = $(this).closest('.items__box_main').find('.items__box').children().length;
                if (totalItems >= 2) {
                    $(this).closest('.items__box_main').find('.items__box button').removeAttr('disabled');
                }
            })

            $(document).on('click', '.removeItems', function() {
                let itemCount = $(this).closest('.items__box').children().length;
                if (itemCount > 1) {
                    if (itemCount <= 2) {
                        $(this).closest('.items__box').find('.input-group button').attr('disabled', true);
                    }
                    $(this).closest('.input-group').remove();
                }
            });

            $(document).on('click', '.removeCard', function() {
                let roomCount = $('.room__card .row').children().length;
                if (roomCount <= 2) {
                    $('.removeCard').attr('disabled', true);
                }
                $(this).closest('.room__main').remove();
            })


            $(document).on('change', 'select[name=room_suite]', function() {
                let roomOrSuite = $(this).val();
                if (roomOrSuite == 1) {
                    $('.roomTypeRooms').removeClass('d-none');
                    $('.suiteTypeRooms').addClass('d-none');
                    $('.suiteTypeRooms').find('input,select').prop('required', false);
                    $('.roomTypeRooms').find('input,select').prop('required', true);
                }
                if (roomOrSuite == 2) {
                    $('.suiteTypeRooms').removeClass('d-none');
                    $('.roomTypeRooms').addClass('d-none');
                    $('.suiteTypeRooms').find('input,select').prop('required', true);
                    $('.roomTypeRooms').find('input,select').prop('required', false);
                }
                initSelect2AutoTokenize();

            });

            $(document).ready(function() {
                $('select[name=room_suite]').change();
            });



        })(jQuery);
    </script>
@endpush


@push('style')
    <style>
        .card .removeCard {
            position: absolute;
            top: -4px;
            right: -4px;
            height: 35px;
            width: 35px;
            border-radius: 50%;
            text-align: center;
        }
        .text--small{
            font-size: 13px;
        }
    </style>
@endpush
