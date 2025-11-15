<div class="main-gallery-section my-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pictures">
                    @foreach ($galleries as $galleryElement)
                        <a class="pictures__item" href="{{ frontendImage('gallery', @$galleryElement->data_values->image) }}">
                            <img src="{{ frontendImage('gallery', @$galleryElement->data_values->image) }}" alt="Gallery Image">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @if ($galleries->hasPages())
            <div class="mt-5">
                {{ paginateLinks($galleries) }}
            </div>
        @endif
    </div>
</div>
