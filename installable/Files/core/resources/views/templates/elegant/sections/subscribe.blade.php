@php
    $content = getContent('subscribe.content', true);
    $policies = getContent('policy_pages.element', false, 1, true);
@endphp
<div class="cta-section" style="background-image: url({{ frontendImage('subscribe', $content?->data_values?->background, '1920x365') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="cta-content">
                    <h3 class="cta-content__title">
                        {{ __($content?->data_values?->heading) }}
                    </h3>
                    <form class="cta-email-form subscribe-form">
                        <input type="email" name="email" placeholder="@lang('Enter your email')" class="form--control" required>

                        <p class="cta-content__text mt-2">
                            {{ __($content?->data_values?->policy_text) }}
                            @foreach ($policies as $policy)
                                <a href="{{ route('policy.pages', $policy->slug) }}" class="link"> {{ __($policy?->data_values?->title) }} </a>
                            @endforeach
                        </p>
                        <button type="submit" class="btn btn--base box--shadow mt-3"> {{ __($content?->data_values?->button_text) }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="text/javascript">
        $('.subscribe-form').on('submit', function(e) {
            var email = $(this).find('input[name=email]').val();

            if (email == '') {
                $(this).find('input[name=email]').focus();
                return false;
            }

            e.preventDefault();
            let url = `{{ route('subscribe') }}`;
            let data = {
                email
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                }
            });
            $.post(url, data, function(response) {
                if (response.errors) {
                    notify('error', response.errors);
                } else {
                    notify('success', response.success);
                }
            });

            this.reset();
        })
    </script>
@endpush
