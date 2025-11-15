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
                                    <th>@lang('ID')</th>
                                    <th>@lang('Room Number')</th>
                                    <th>@lang('Status')</th>
                                    @can(['admin.hotel.room.status', 'admin.hotel.room.add'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $room)
                                    <tr>
                                        <td> {{ $loop->index + 1 }}</td>
                                        <td> {{ $room->room_number }}</td>
                                        <td> @php echo $room->statusBadge @endphp </td>
                                        @can(['admin.hotel.room.status', 'admin.hotel.room.add'])
                                            <td>
                                                <div class="button--group">
                                                    @can('admin.hotel.room.add')
                                                        <button class="btn btn-sm btn-outline--primary editBtn" data-action="{{ route('admin.hotel.room.update', [$roomType->id, $room->id]) }}" data-resource='@json($room)'><i class="las la-pencil-alt"></i> @lang('Edit')</button>
                                                    @endcan

                                                    @if ($room->status == Status::ENABLE)
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.hotel.room.status', $room->id) }}" data-question="@lang('Are your to disable this room?')" type="button">
                                                            <i class="la la-eye-slash"></i>@lang('Disable')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.hotel.room.status', $room->id) }}" data-question="@lang('Are your to enable this room?')" type="button">
                                                            <i class="la la-eye"></i>@lang('Enable')
                                                        </button>
                                                    @endif
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
                @if ($rooms->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($rooms) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @can('admin.hotel.room.add')
        <div class="modal fade" id="createModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Add New Room')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>@lang('Room Number')</label>
                                <div class="d-flex">
                                    <div class="input-group row gx-0">
                                        <input type="text" class="form-control" name="room_number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="append-item d-none"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('admin.hotel.room.status')
        <x-confirmation-modal />
    @endcan
@endsection

@can(['admin.hotel.room.add', 'admin.hotel.room.type.all'])
    @push('breadcrumb-plugins')
        @can('admin.hotel.room.add')
            <button class="btn btn-outline--primary addNew" data-action="{{ route('admin.hotel.room.add', $roomType->id) }}"><i class="las la-plus"></i> @lang('Add New')</button>
        @endcan

        @can('admin.hotel.room.type.all')
            <x-back route="{{ route('admin.hotel.room.type.all') }}" />
        @endcan
    @endpush
@endcan

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.addNew').on('click', function() {
                let modal = $('#createModal');
                let action = $(this).data('action');
                modal.find('input[name=room_number]').val('');
                modal.find('form').attr('action', action);
                modal.modal('show');
            })

            $('.editBtn').on('click', function() {
                let modal = $('#createModal');
                let resource = $(this).data('resource');
                let action = $(this).data('action');
                modal.find('input[name=room_number]').val(resource.room_number);
                modal.find('form').attr('action', action);
                modal.modal('show');
            })

        })(jQuery);
    </script>
@endpush
