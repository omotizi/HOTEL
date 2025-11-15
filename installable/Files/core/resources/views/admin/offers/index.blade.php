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
                                    <th>@lang('Discount Type')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Total Items')</th>
                                    <th>@lang('Expire Date')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($offers as $offer)
                                    <tr>
                                        <td>{{ $offer->name }}</td>
                                        <td> @php echo $offer->discountTypeBadge() @endphp </td>
                                        <td>
                                            <span class="fw-bold">
                                                @if ($offer->discount_type == Status::DISCOUNT_FIXED)
                                                    {{ showAmount($offer->amount) }}
                                                @else
                                                    {{ showAmount($offer->amount, currencyFormat: false) }}%
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ $offer->total_roomTypes }}</td>
                                        <td> {{ showDateTime($offer->ends_at, 'd M, Y') }} </td>
                                        <td>
                                            @php echo $offer->statusBadge @endphp
                                        </td>
                                        <td>
                                            @can(['admin.offer.status','admin.offer.edit'])
                                            <div class="button--group">
                                                @can('admin.offer.edit')
                                                <a href="{{ route('admin.offer.edit', $offer->id) }}" class="btn btn-outline--primary btn-sm">
                                                    <i class="la la-pencil"></i>@lang('Edit')
                                                </a>
                                                @endcan

                                                @can('admin.offer.status')
                                                    @if ($offer->status == Status::DISABLE)
                                                        <button class="btn btn-sm btn-outline--success me-1 confirmationBtn" data-action="{{ route('admin.offer.status', $offer->id) }}" data-question="@lang('Are you sure to enable this offer?')" type="button">
                                                            <i class="la la-eye"></i> @lang('Enable')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.offer.status', $offer->id) }}" data-question="@lang('Are you sure to disable this offer?')" type="button">
                                                            <i class="la la-eye-slash"></i> @lang('Disable')
                                                        </button>
                                                    @endif
                                                @endcan
                                            @endcan

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>

                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($offers->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($offers) }}
                </div>
            @endif
        </div>
    </div>
</div>

<x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
<div class="d-flex gap-3">
    <x-search-form placeholder="Name" />
    @can('admin.offer.create')
    <a href="{{ route('admin.offer.create') }}" class="btn btn-sm btn-outline--primary flex-shrink-0"> <i class="las la-plus"></i> @lang('Add New')</a>
    @endcan
</div>
@endpush


