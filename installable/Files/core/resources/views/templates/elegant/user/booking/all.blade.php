@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="style-left d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <h4 class="section-heading__title mb-0">{{ __($pageTitle) }}</h4>
            <div class="search-form">
                <x-search-form btn="btn--base" />
            </div>
        </div>

        @include('Template::partials.booking_history_table')

        @if ($bookings->hasPages())
            {{ paginateLinks($bookings) }}
        @endif
    </div>
@endsection
