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
                                    <th>@lang('Booking Number')</th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Discount Amount')</th>
                                    <th>@lang('Applied Date')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($appliedCoupons as $appliedCoupon)
                                    <tr>
                                        <td>
                                            <a href="{{ can('admin.booking.details') ? route('admin.booking.details', $appliedCoupon->booking->id) : 'javascript:void(0)' }}">#{{ $appliedCoupon->booking->booking_number }}</a>
                                        </td>
                                        <td>
                                            @if ($appliedCoupon->user)
                                                @can('admin.users.detail')
                                                <a href="{{ route('admin.users.detail', $appliedCoupon->user->id) }}">{{ $appliedCoupon->user->username }}</a>
                                                @else
                                                 --
                                                @endcan
                                            @else
                                                <span>@lang('N/A')</span>
                                            @endif
                                        </td>
                                        <td>{{ showAmount($appliedCoupon->amount) }}</td>
                                        <td>
                                            {{ showDateTime($appliedCoupon->created_at) }}
                                        </td>
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

                @if ($appliedCoupons->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($appliedCoupons) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="d-flex gap-3">
        <x-search-form />
        @can('admin.coupon.index')
            <x-back route="{{ route('admin.coupon.index') }}" />
        @endcan
    </div>
@endpush
