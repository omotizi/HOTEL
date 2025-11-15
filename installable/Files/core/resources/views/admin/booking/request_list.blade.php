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
                                    <th>@lang('S.N')</th>
                                    <th>@lang('Username') | @lang('Email')</th>
                                    <th>@lang('Check In') | @lang('Check Out')</th>
                                    <th>@lang('Booked For')</th>
                                    <th>@lang('Fare /Night') | @lang('Total Fare')</th>
                                    @can(['admin.request.booking.approve', 'admin.request.booking.cancel'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookingRequests as $bookingRequest)
                                    <tr>
                                        <td>{{ $bookingRequests->firstItem() + $loop->index }}</td>
                                        <td>
                                            <span class="small">
                                                @if ($bookingRequest->user)
                                                    @can('admin.users.detail')
                                                        <a href="{{ route('admin.users.detail', $bookingRequest->user_id) }}">
                                                            <span>@</span>{{ $bookingRequest->user->username }}
                                                        </a>
                                                    @else
                                                        {{ $bookingRequest->user->username }}
                                                    @endcan
                                                @else
                                                    {{ $bookingRequest->guest->name }}
                                                @endif
                                            </span>
                                            <br>
                                            <span>+{{ $bookingRequest->user ? $bookingRequest->user->mobile : $bookingRequest->guest->mobile }}</span>
                                        </td>
                                        <td>
                                            <span>{{ showDateTime($bookingRequest->check_in, 'd M Y') }}</span><br>
                                            <span>{{ showDateTime($bookingRequest->check_out, 'd M Y') }}</span>
                                        </td>
                                        <td>
                                            {{ $bookingRequest->bookFor() }} @lang('Night')
                                            <br>
                                            <span>
                                                {{ $bookingRequest->roomBookingRequest->count() }} @lang('Room')
                                            </span>
                                        </td>
                                        <td>
                                            {{ showAmount($bookingRequest->amount) }}
                                            <span class="text--danger">+ {{ showAmount($bookingRequest->taxPercentage(), currencyFormat: false) }}% {{ __(gs()->tax_name) }}</span>
                                            <br>
                                            <span class="fw-bold">{{ showAmount($bookingRequest->totalFare()) }}</span>
                                        </td>

                                        @can(['admin.request.booking.approve', 'admin.request.booking.cancel'])
                                            <td>
                                                <div class="button--group">
                                                    @can('admin.request.booking.approve')
                                                        <a class="btn btn-sm btn-outline--success" href="{{ route('admin.request.booking.approve', $bookingRequest->id) }}"><i class="las la-check"></i>@lang('Approve')</a>
                                                    @endcan

                                                    @can('admin.request.booking.cancel')
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.request.booking.cancel', $bookingRequest->id) }}" data-question="@lang('Are you sure, you want to cancel this booking request?')"><i class="las la-times-circle"></i>@lang('Cancel')
                                                        </button>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($bookingRequests->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($bookingRequests) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @can('admin.request.booking.cancel')
        <x-confirmation-modal />
    @endcan
@endsection

@push('breadcrumb-plugins')
    @can('admin.booking.active')
        <a class="btn btn--success" href="{{ route('admin.booking.active') }}"><i class="las la-check-circle"></i>@lang('Active Bookings')</a>
    @endcan
    @can('admin.request.booking.canceled')
        <a class="btn btn-outline--danger" href="{{ route('admin.request.booking.canceled') }}"><i class="las la-times-circle"></i>@lang('Canceled Requests')</a>
    @endcan
    <x-search-form placeholder="User/Email" />
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('select[name="booking_request"]').on('change', function() {
                $(this).closest('form').submit();
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .filter-request .select2-container {
            min-width: 180px !important;
        }
    </style>
@endpush
