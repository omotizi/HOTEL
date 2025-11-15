<table class="table table--responsive--lg">
    <thead>
        <tr>
            <th>@lang('Check In') - @lang('Check Out')</th>
            <th>@lang('Rooms/Suites') | @lang('Nights')</th>
            <th>@lang('Total Fare') </th>
            <th>@lang('Status')</th>
            <th>@lang('Action')</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookingRequests as $bookingRequest)
            <tr>
                <td>
                    {{ showDateTime($bookingRequest->check_in, 'd M, Y') }} - {{ showDateTime($bookingRequest->check_out, 'd M, Y') }}
                </td>

                <td>
                    <div>
                        <span>
                            @if ($bookingRequest->total_rooms)
                                {{ $bookingRequest->total_rooms }} {{ __(Str::plural('room', $bookingRequest->total_rooms)) . ($bookingRequest->total_suites ? ',' : '') }}
                            @endif

                            @if ($bookingRequest->total_suites)
                                {{ $bookingRequest->total_suites }} {{ __(Str::plural('suite', $bookingRequest->total_suites)) }}
                            @endif
                        </span>
                        <br>
                        <span>@lang('for') {{ $bookingRequest->bookFor() }} {{ __(Str::plural('night', $bookingRequest->bookFor())) }}</span>
                    </div>
                </td>

                <td>
                    <div>
                        <span class="fw-bold">{{ showAmount($bookingRequest->totalFare()) }}</span>
                        <br>
                        <small>@lang('Including') <span class="fw-bold text-black">{{ __(getAmount($bookingRequest->taxPercentage())) }}%</span> {{ gs('tax_name') }}</small>
                    </div>
                </td>

                <td>
                    @php echo $bookingRequest->statusBadge; @endphp
                </td>

                <td>
                    <div class="d-flex justify-content-end flex-wrap align-items-center gap-2">
                        <button class="btn btn--sm btn-outline--base detailBtn" data-resource="{{ json_encode($bookingRequest->roomBookingRequest) }}"><i class="las la-desktop"></i> @lang('Detail')</button>
                        <button class="btn btn--sm btn-outline--danger confirmationBtn" data-action="{{ route('user.booking.request.cancel', $bookingRequest->id) }}" data-question="@lang('Are you sure to cancel this request?')"><i class="las la-times-circle"></i> @lang('Cancel')</button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal -->
<div class="modal custom--modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Requested Rooms/Suites Details')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderd">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Type')</th>
                            <th>@lang('Requested Room Qty')</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function($) {
            'use strict';
            $('.detailBtn').on('click', function() {
                let resource = $(this).data('resource');
                let content = '';
                $.each(resource, function(i, element) {
                    content += `
                        <tr>
                        <td>${element.room_type.name}</td>
                        <td>${element.room_type.room_suite == 2 ? 'Suite' : 'Room'}</td>
                        <td>${element.quantity}</td>
                    </tr>`;
                });

                let modal = $('#detailModal');
                modal.find('.modal-body').find('table tbody').html(content);
                modal.modal('show');
            })
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        #detailModal .table.table-borderd thead tr th {
            background: none;
            color: hsl(var(--black) / 0.8);
            border-bottom: 1px solid #f1f5f9;
        }
    </style>
@endpush
