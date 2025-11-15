@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Status')</th>
                                    @can(['admin.hotel.amenity.save', 'admin.hotel.amenity.status'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($amenities as $item)
                                    @php
                                        $item->image_with_path = getImage(getFilePath('amenity') . '/' . $item->image, getFileSize('amenity'));
                                    @endphp

                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ $item->image_with_path }}" alt="">
                                                </div>
                                                <span class="ms-2">{{ $item->title }}</span>
                                            </div>
                                        </td>
                                        <td> @php echo $item->statusBadge @endphp </td>
                                        @can(['admin.hotel.amenity.save', 'admin.hotel.amenity.status'])
                                            <td>
                                                <div class="button--group">
                                                    @can('admin.hotel.amenity.save')
                                                        <button class="btn btn-sm btn-outline--primary cuModalBtn" data-has_status="1" data-modal_title="@lang('Update Amenity')" data-resource="{{ $item }}" type="button">
                                                            <i class="la la-pencil"></i>@lang('Edit')
                                                        </button>
                                                    @endcan
                                                    @can('admin.hotel.amenity.status')
                                                        @if ($item->status == Status::DISABLE)
                                                            <button class="btn btn-sm btn-outline--success me-1 confirmationBtn" data-action="{{ route('admin.hotel.amenity.status', $item->id) }}" data-question="@lang('Are you sure to enable this amenities?')" type="button"><i class="la la-eye"></i> @lang('Enable')
                                                            </button>
                                                        @else
                                                            <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.amenity.status', $item->id) }}" data-question="@lang('Are you sure to disable this amenities?')" type="button"><i class="la la-eye-slash"></i> @lang('Disable')
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($amenities->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($amenities) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @can('admin.hotel.amenity.save')
        <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add Amenties')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.hotel.amenity.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Amenities Title')</label>
                                <input class="form-control" name="title" required type="text" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label> @lang('Image')</label>
                                <x-image-uploader type="amenity" class="w-100" :required="false" />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    @can('admin.hotel.amenity.status')
        <x-confirmation-modal />
    @endcan
@endsection

@can('admin.hotel.amenity.save')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary addBtn cuModalBtn" data-modal_title="@lang('Add New Amenity')" type="button">
            <i class="las la-plus"></i>@lang('Add New ')
        </button>
    @endpush
@endcan

@push('script')
    <script>
        (function($) {
            'use strict';
            $('.addBtn').on('click', function(){
                var modal = $('#cuModal');
                modal.find('.image-upload-preview').css("background-image", `url({{ getImage(null, getFileSize('amenity')) }})`);
            });
        })(jQuery);
    </script>
@endpush
