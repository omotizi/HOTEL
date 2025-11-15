@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="my-60">
        <div class="container">
            <div class="pb-5">
                <h2 class="text-center">{{ __($pageTitle) }}</h2>
            </div>
            @php
                echo $cookie?->data_values?->description;
            @endphp
        </div>
    </section>
@endsection
