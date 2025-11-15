@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog-detials py-120">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-xxl-8 col-lg-7">
                    <div class="blog-details">
                        <div class="blog-details__thumb">
                            <img src="{{ frontendImage('blog', $blog?->data_values?->image, '860x605') }}" class="fit-image" alt="blog">
                        </div>
                        <div class="blog-details__content">
                            <div class="d-flex align-items-center gap-3 flex-wrap">

                                <span class="blog-item__text">
                                    <span class="blog-item__text-icon"><i class="las la-calendar-check"></i></span> {{ showDateTime($blog->created_at, 'd M Y') }}
                                </span>
                                <span class="blog-item__text">
                                    <span class="blog-item__text-icon"><i class="las la-icons"></i>
                                    </span>
                                    {{ __($blog?->data_values?->category) }}
                                </span>
                                <span class="blog-item__text">
                                    <span class="blog-item__text-icon"><i class="las la-book-reader"></i>
                                    </span>
                                    {{ __(@$blog->data_values->read_time) }}
                                </span>
                            </div>
                            <h3 class="blog-details__title"> {{ __($blog?->data_values?->title) }} </h3>
                            <div>
                                @php
                                    echo $blog->data_values->description;
                                @endphp
                            </div>
                            <div class="blog-details__share">
                                <p class="blog-details__share-title"> @lang('Share this post on:')</p>
                                <ul class="social-list">
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center twitter" href="https://twitter.com/intent/tweet?text={{ __($blog->data_values->title) }}&amp;url={{ urlencode(url()->current()) }}" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ __($blog->data_values->title) }}&amp;summary=@php echo strLimit(strip_tags($blog->data_values->description),100) @endphp" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center instagram" href="https://www.instagram.com/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar__bottom">
                            <div class="blog-sidebar">
                                <h6 class="blog-sidebar__title"> @lang('Latest Posts') </h6>
                                @foreach ($blogLists as $listItem)
                                    <div class="latest-blog">
                                        <div class="latest-blog__thumb">
                                            <a href="{{ route('blog.details', $listItem->slug) }}"> <img src="{{ frontendImage('blog', 'thumb_' . $listItem?->data_values?->image, '420x295') }}" class="fit-image" alt="blog"></a>
                                        </div>
                                        <div class="latest-blog__content">
                                            <span class="latest-blog__date"> {{ showDateTime($listItem->created_at, 'd M Y') }} </span>
                                            <h6 class="latest-blog__title"><a href="{{ route('blog.details', $listItem->slug) }}"> {{ __($listItem->data_values->title) }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
