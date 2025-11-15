@extends($activeTemplate . 'layouts.app')

@section('layout')
    @include('Template::partials.header', ['banner' => $banner ?? true])

    <main>
        @include('Template::partials.dashboard_menu')
        <section class="py-80">
            @yield('content')
        </section>
    </main>
    @include('Template::partials.footer')
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });

            $('.search-form [name=search]').addClass('form--control');

            let disableSubmission = false;
            $('.disableSubmission').on('submit', function(e) {
                if (disableSubmission) {
                    e.preventDefault()
                } else {
                    disableSubmission = true;
                }
            });
        })(jQuery);
    </script>
@endpush

