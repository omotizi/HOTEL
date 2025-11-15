@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="text-end pb-3">
            <a href="{{ route('ticket.open') }}" class="btn btn--base">@lang('Open Ticket')</a>
        </div>
        <div class="col-md-12">
            <table class="table table--responsive--lg">
                <thead>
                    <tr>
                        <th>@lang('S.N.')</th>
                        <th>@lang('Subject')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Priority')</th>
                        <th>@lang('Last Reply')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($supports as $support)
                        <tr>
                            <td> {{ $supports->firstItem() + $loop->index }}</td>
                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a>
                            </td>
                            <td>
                                @php echo $support->statusBadge; @endphp
                            </td>
                            <td>
                                @if ($support->priority == Status::PRIORITY_LOW)
                                    <span class="badge badge-two badge--dark">@lang('Low')</span>
                                @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                    <span class="badge badge-two badge--secondary">@lang('Medium')</span>
                                @elseif($support->priority == Status::PRIORITY_HIGH)
                                    <span class="badge badge-two badge--primary">@lang('High')</span>
                                @endif
                            </td>
                            <td>{{ diffForHumans($support->last_reply) }} </td>
                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}" title="@lang('View')" class="btn btn--sm btn-outline--base">
                                    <i class="las la-desktop"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $supports->links() }}
        </div>
    </div>
@endsection
