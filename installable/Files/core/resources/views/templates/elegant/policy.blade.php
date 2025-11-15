@extends($activeTemplate . 'layouts.frontend', ['banner' => false])
@section('content')
    @include($activeTemplate . 'partials.banner', ['type' => 'blog', 'size' => '1920x570', 'class' => 'policy-banner'])

    <section class="my-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    @php
                        echo $policy?->data_values?->details;
                    @endphp
                </div>
            </div>
        </div>
    </section>
@endsection
