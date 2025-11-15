@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="style-left">
            <h4 class="section-heading__title"> {{ $pageTitle }} </h4>
        </div>

        @include('Template::partials.booking_request_table')
    </div>
    <x-confirmation-modal :custom=true/>
@endsection
