<div class="col-lg-4 col-md-6">
    <div class="blog-item">
        <div class="blog-item__thumb">
            <a href="{{ route('blog.details', $blog->slug) }}" class="blog-item__thumb-link">
                <img class="image1" src="{{ frontendImage('blog', 'thumb_' . $blog->data_values->image, '430x300') }}" alt="blog">
                <img class="image2" src="{{ frontendImage('blog', 'thumb_' . $blog->data_values->image, '430x300') }}" alt="blog">
            </a>
        </div>
        <div class="blog-item__content">
            <div class="blog-item__top">
                <span class="badge badge--base badge-two"> {{ __($blog->data_values->category) }} </span>
                <span class="blog-item__date"> {{ __($blog->data_values->read_time) }} @lang('read') </span>
            </div>
            <h5 class="blog-item__title">
                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-item__title-link border-effect">
                    {{ strLimit(trans($blog->data_values->title), 70) }}
                </a>
            </h5>
            <p class="blog-item__desc">
                @php echo strLimit(strip_tags($blog->data_values->description), 150)  @endphp
            </p>
            <a href="{{ route('blog.details', $blog->slug) }}" class="blog-item__btn">@lang('Read More') <span class="blog-item__btn-icon"><i class="las la-arrow-right"></i></span>
            </a>
        </div>
    </div>
</div>
