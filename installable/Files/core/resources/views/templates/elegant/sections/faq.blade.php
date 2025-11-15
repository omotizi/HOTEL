@php
    $content = getContent('faq.content', true);
    $elements = getContent('faq.element', false, null, true);
@endphp

<section class="faq-section my-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title">{{ __($content?->data_values?->heading) }}</h2>
                    <p class="section-heading__desc">{{ __($content?->data_values?->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion custom--accordion" id="accordionExample">
                    @foreach ($elements as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" @if($key == 0) aria-expanded="true" @else aria-expanded="false" @endif  aria-controls="collapse{{ $item->id }}">
                                    {{ __($item->data_values->question) }}
                                </button>
                            </h2>
                            <div id="collapse{{ $item->id }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $item->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="text">{{ __($item->data_values->answer) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
