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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Code')</th>
                                    <th>@lang('Discount Type')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Applied Coupon')</th>
                                    <th>@lang('Expire Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_name ?? 'Unnamed' }}</td>
                                        <td> {{ $coupon->coupon_code }} </td>
                                        <td>@php echo $coupon->discountTypeBadge() @endphp</td>
                                        <td>
                                            <span class="fw-bold">
                                                @if ($coupon->discount_type == Status::DISCOUNT_FIXED)
                                                    {{ showAmount($coupon->coupon_amount) }}
                                                @else
                                                    {{ showAmount($coupon->coupon_amount, currencyFormat: false) }}%
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            @php echo $coupon->badgeData() @endphp
                                        </td>
                                        <td>
                                            <a href="{{ can('admin.coupon.applied') ? route('admin.coupon.applied', $coupon->id) : 'javascript:void(0)' }}" class="badge badge--info">{{ $coupon->applied_coupons_count }}</a>
                                        </td>
                                        <td class="{{ $coupon->expired_at < now() ? 'text--danger' : '' }}">
                                            {{ showDateTime($coupon->expired_at, 'd M, Y h:i A') }}
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                @can('admin.coupon.edit')
                                                    <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-outline--primary btn-sm edit-btn"><i class="la la-pencil"></i>@lang('Edit')</a>
                                                @endcan

                                                @can('admin.coupon.status.change')
                                                    @if ($coupon->status == Status::DISABLE)
                                                        <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.coupon.status.change', $coupon->id) }}" data-question="@lang('Are you sure to enable this coupon?')" type="button">
                                                            <i class="la la-eye"></i>@lang('Enable')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.coupon.status.change', $coupon->id) }}" data-question="@lang('Are you sure to disable this coupon?')" type="button">
                                                            <i class="la la-eye-slash"></i>@lang('Disable')
                                                        </button>
                                                    @endif
                                                @endcan
                                            </div>
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

                @if ($coupons->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($coupons) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @can('admin.coupon.status.change')
        <x-confirmation-modal />
    @endcan
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Name, Code" />
    @can('admin.coupon.create')
        <a href="{{ route('admin.coupon.create') }}" class="btn btn-sm btn-outline--primary"> <i class="las la-plus"></i> @lang('Add New')</a>
    @endcan
@endpush
