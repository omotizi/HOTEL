@php
    $breadcrumbImageContent = getContent('breadcrumb_images.content', true);
    $breadcrumb_image = $type . '_breadcrumb_image';
    $size = null;
@endphp

<section class="banner-section room-details-banner bg-img pb-0 {{ isset($class) ? $class : '' }}"
    data-background-image="{{ frontendImage('breadcrumb_images', $breadcrumbImageContent?->data_values?->$breadcrumb_image, $size) }}">
    <div class="container h-100 flex-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h2 class="banner-content__title mb-0"> {{ __($pageTitle) }} </h2>
                </div>
            </div>
        </div>
    </div>
</section>


