@extends('frontend.layout')

@section('pageHeading')
  {{ __('Home') }}
@endsection

@php
  $metaKeywords = !empty($seo->meta_keyword_home) ? $seo->meta_keyword_home : '';
  $metaDescription = !empty($seo->meta_description_home) ? $seo->meta_description_home : '';
@endphp
@section('meta-keywords', "{{ $metaKeywords }}")
@section('meta-description', "$metaDescription")
@section('styles')
  @include('frontend.theme_five.include.styles')

@endsection
@section('content')

  @php
    if (!empty($hero)) {
        $img = $hero->img;
        $title = $hero->title;
        $subtitle = $hero->subtitle;
        $btnUrl = $hero->btn_url;
        $btnName = $hero->btn_name;
    } else {
        $img = '';
        $title = '';
        $subtitle = '';
        $btnUrl = '';
        $btnName = '';
    }
    $maxDays = App\Models\PackageManagement\Package::max('number_of_days');
  @endphp


  @if ($websiteInfo->home_version == 'slider')
    @includeIf('frontend.theme_five.hero.slider')
  @endif

  @if ($sections?->intro_section == 1)

    <section class="about-area about-1 pt-100 pb-60">
      <div class="container">
        <div class="row align-items-center gx-xl-5">
          <div class="col-lg-7 aos-init aos-animate" data-aos="fade-up">
            <div class="image mb-40">
              <div class="img-1">
                <img class="blur-up ls-is-cached lazyloaded"
                  src="{{ asset('assets/img/intro_section/' . $intro->intro_img) }}"
                  data-src="{{ asset('assets/img/intro_section/' . $intro->intro_img) }}" alt="Image">
              </div>

            </div>
          </div>
          <div class="col-lg-5 aos-init aos-animate" data-aos="fade-up">
            <div class="content-title mb-40">
              @if (!is_null($intro))
                <h2 class="title mb-20">
                  {{ $intro->intro_primary_title }}
                </h2>
                <p>
                  {{ $intro->intro_text }}
                </p>
              @endif

              <div class="info-list mt-40">
                <div class="row align-items-center">
                  @if (count($counterInfos) > 0)
                    @foreach ($counterInfos as $counterInfo)
                      <div class="col-md-6 col-lg-12 col-xxl-6">
                        <div class="card mb-30">
                          <div class="card-icon rounded-pill">
                            <i class="{{ $counterInfo->icon }}"></i>
                          </div>
                          <div class="card-content">
                            <h6 class="mb-2">{{ $counterInfo->title }}</h6>

                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

  @endif
  
@if($sections?->room_feature_section == 1)

  <section class="category-area category-1 pt-100 pb-75 bg-img z-1 lazyloaded" data-bg-image="assets/images/category-bg-1.jpg" style="background-image: url(&quot;assets/images/category-bg-1.jpg&quot;); background-size: cover; background-position: center center; display: block;">
        <div class="overlay opacity-75"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title title-center mw-100 mb-50 aos-init aos-animate" data-aos="fade-up">
                         @if(!is_null($secHeading))
                        <h2 class="title">{{ $secHeading->room_feature_category_title }}</h2>
                        @endif
                        
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                      @foreach($room_categories as $room_category)
                        <div class="col-lg-4 aos-init aos-animate" data-aos="fade-up">
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="card radius-md mb-25">
                                        <a href="{{ route('rooms',['category' => $room_category->id]) }}" target="_self" title="Link">
                                            <div class="card-img">
                                                <div class="lazy-container ratio ratio-5-3">
                                                    <img class=" ls-is-cached lazyloaded" src="{{ asset('assets/img/rooms/category/'.$room_category->image) }}" data-src="{{ asset('assets/img/rooms/category/'.$room_category->image) }}" alt="Product">
                                                </div>
                                            </div>
                                            <div class="card-text text-center">
                                                <h5 class="card-title mb-1">{{ $room_category->name }}</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                    </div>
                    <div class="text-center mt-20 aos-init aos-animate" data-aos="fade-up">
                    <a href="{{ route('rooms') }}" class="btn btn-lg btn-primary fancy">{{ __('View All Categories') }}</a>
                  </div>
                </div>
            </div>
        </div>
    </section>

  @endif  

  @if ($sections?->featured_rooms_section == 1)
    <!-- Product-area start -->
    <section class="product-area ptb-100">
      <div class="container">
        <div class="row">
          <div class="col-12 aos-init aos-animate" data-aos="fade-up">
            <div class="section-title title-inline mb-50 aos-init aos-animate" data-aos="fade-up">
              @if (!empty($secHeading))
                <h2 class="title">{{ convertUtf8($secHeading->room_section_title) }}</h2>
              @endif
              <a href="{{ route('rooms') }}" class="btn btn-lg btn-primary" target="_self" title="Show More">{{ __('Show More') }}</a>
            </div>
          </div>
          <div class="col-12">
            <div
              class="swiper product-inline-slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
              id="product-inline-slider-1" data-slides-per-view="2">
              <div class="swiper-wrapper" id="swiper-wrapper-3364fcdffd261b82" aria-live="off"
                style="transform: translate3d(-1321px, 0px, 0px); transition-duration: 0ms;">

                @foreach ($roomInfos as $roomInfo)
                  @if (!empty($roomInfo->room))
                    <div class="swiper-slide aos-init aos-animate swiper-slide-active" data-aos="fade-up"
                      data-swiper-slide-index="{{ $roomInfo->id }}" role="group" aria-label="1 / 2"
                      style="width: 635.5px; margin-right: 25px;">
                      <div class="row g-0 product-default product-column border radius-md mb-25 align-items-center">
                        <figure class="product-img col-sm-12 col-md-5">
                          <a href="{{ route('room_details', ['id' => $roomInfo->room_id, 'slug' => $roomInfo->slug]) }}"
                            class="lazy-container ratio ratio-5-4" target="_self" title="Link">
                            <img class=" ls-is-cached lazyloaded"
                              src="{{ asset('assets/img/rooms/' . $roomInfo->room->featured_img) }}"
                              data-src="{{ asset('assets/img/rooms/' . $roomInfo->room->featured_img) }}" alt="Product">
                          </a>
                        </figure>
                        <div class="product-details col-sm-12 col-md-7">
                          <div class="d-flex align-items-center gap-3">
                            <span class="product-tag border radius-sm">
                              {{ $roomInfo->roomCategory->name }}
                            </span>

                            <div class="product-price">
                              <span class="h6 new-price color-primary">
                                {{ $currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : '' }}
                                {{ $roomInfo->room->rent }}
                                {{ $currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : '' }}
                                / {{ __('Night') }}
                              </span>

                            </div>


                          </div>
                          <h5 class="product-title lc-2 mt-2 mb-15">
                            <a href="{{ route('room_details', ['id' => $roomInfo->room_id, 'slug' => $roomInfo->slug]) }}"
                              target="_self"
                              title="Link">{{ strlen($roomInfo->title) > 50 ? mb_substr($roomInfo->title, 0, 150, 'utf-8') . '...' : $roomInfo->title }}</a>
                          </h5>

                          <ul class="product-icon-list list-unstyled d-flex align-items-center">
                            <li class="icon-start">
                              <i class="fal fa-bed"></i>
                              <span>
                                {{ $roomInfo->room->bed }}
                                {{ $roomInfo->room->bed }} {{ $roomInfo->room->bed == 1 ? __('Bed') : __('Beds') }}
                              </span>
                            </li>

                            <li class="icon-start">
                              <i class="fal fa-bath"></i>
                              <span> {{ $roomInfo->room->bath }}
                                {{ $roomInfo->room->bath == 1 ? __('Bath') : __('Baths') }}</span>
                            </li>
                            <li class="icon-start">
                              <i class="fal fa-bath"></i>
                              <span> {{ $roomInfo->room->max_guests }}
                                {{ $roomInfo->room->max_guests == 1 ? __('Guest') : __('Guests') }}</span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  @endif
                @endforeach


              </div>
              <div
                class="swiper-pagination position-static swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"
                id="product-inline-slider-1-pagination"><span
                  class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                  aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet"
                  tabindex="0" role="button" aria-label="Go to slide 2"></span></div>
              <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
  <!-- Product-area end -->

  @if ($sections?->latest_room_section == 1)
    <!-- Room latest Section Start -->
    <section class="product-area ptb-100">
      <div class="container">
        <div class="row">
          <div class="col-12 aos-init aos-animate" data-aos="fade-up">
            <div class="section-title title-center mb-50 aos-init aos-animate" data-aos="fade-up">
              @if (!empty($secHeading))
                <h2 class="title mb-30">
                  {{ $secHeading->latest_room_section_title }}
                </h2>
              @endif
              <div class="tabs-navigation">
                <ul class="nav nav-tabs" data-hover="fancyHover" role="tablist">
                  <li class="nav-item active" role="presentation">
                    <button class="nav-link hover-effect active btn-md radius-sm" data-bs-toggle="tab"
                      data-bs-target="#tab1" type="button" aria-selected="true" role="tab">{{ __('All Rooms') }}</button>
                  </li>
                  @foreach ($room_categories as $category)
                    <li class="nav-item" role="presentation">
                      <button class="nav-link hover-effect  btn-md radius-sm" data-bs-toggle="tab"
                        data-bs-target="#tab{{ $category->id }}" type="button" aria-selected="true"
                        role="tab">{{ $category->name }}</button>
                    </li>
                  @endforeach
                  <span class="target"
                    style="width: 141px; height: 43px; left: 715px; top: 3572px; transform: none; border-radius: 5px;"></span>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="tab-content">

              <div class="tab-pane slide show active" id="tab1" role="tabpanel">
                <div class="row">
                  @foreach ($roomLetestInfos as $roomInfo)
                    @if ($roomInfo->room)
                      <div class="col-lg-6 aos-init aos-animate" data-aos="fade-up">
                        <div class="row g-0 product-default product-column border radius-md mb-25 align-items-center">
                          <figure class="product-img col-sm-12 col-md-5">
                            <a href="{{ route('rooms') }}" class="lazy-container ratio ratio-5-4" target="_self"
                              title="Link">
                              <img class=" ls-is-cached lazyloaded"
                                src="{{ asset('assets/img/rooms/' . $roomInfo->room->featured_img) }}"
                                data-src="{{ asset('assets/img/rooms/' . $roomInfo->room->featured_img) }}"
                                alt="Product">
                            </a>
                          </figure>
                          <div class="product-details col-sm-12 col-md-7">
                            <div class="d-flex align-items-center gap-3">
                              @if ($websiteInfo->room_category_status == 1)
                                <span class="product-tag border radius-sm">
                                  {{ $roomInfo->roomCategory->name }}
                                </span>
                              @endif
                              <div class="product-price">
                                <span
                                  class="h6 new-price color-primary">{{ $currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : '' }}
                                  {{ $roomInfo->room->rent }}
                                  {{ $currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : '' }}
                                  / {{ __('Night') }}</span>

                              </div>
                            </div>
                            <h5 class="product-title lc-2 mt-2 mb-15">
                              <a href="{{ route('room_details', ['id' => $roomInfo->room_id, 'slug' => $roomInfo->slug]) }}"
                                target="_self" title="Link">{{ convertUtf8($roomInfo->title) }}</a>
                            </h5>

                            <ul class="product-icon-list list-unstyled d-flex align-items-center">
                              <li class="icon-start">
                                <i class="fal fa-bed"></i>
                                <span>{{ $roomInfo->room->bed }}
                                  {{ $roomInfo->room->bed == 1 ? __('Bed') : __('Beds') }}</span>
                              </li>
                              <li class="icon-start">
                                <i class="fal fa-bath"></i>
                                <span>{{ $roomInfo->room->bath }}
                                  {{ $roomInfo->room->bath == 1 ? __('Bath') : __('Baths') }} </span>
                              </li>
                              <li class="icon-start">
                                <i class="fal fa-user-friends"></i>
                                <span>{{ $roomInfo->room->max_guests }}
                                  {{ $roomInfo->room->max_guests == 1 ? __('Guest') : __('Guests') }}</span>
                              </li>
                            </ul>
                          </div>
                        </div><!-- product-default -->
                      </div>
                    @endif
                  @endforeach
                </div>
              </div>

              @foreach ($room_categories as $room_category)
                <div class="tab-pane slide" id="tab{{ $room_category->id }}" role="tabpanel">
                  <div class="row">
                    @foreach (App\Models\RoomManagement\RoomContent::with('room')->where('language_id', $language->id)->where('room_category_id', $room_category->id)->paginate(6) as $roomInfo)
                      @if ($roomInfo->room)
                        <div class="col-lg-6 aos-init aos-animate" data-aos="fade-up">
                          <div class="row g-0 product-default product-column border radius-md mb-25 align-items-center">
                            <figure class="product-img col-sm-12 col-md-5">
                              <a href="{{ route('rooms') }}" class="lazy-container ratio ratio-5-4" target="_self"
                                title="Link">
                                <img class=" ls-is-cached lazyloaded"
                                  src="{{ asset('assets/img/rooms/' . $roomInfo->room->featured_img) }}"
                                  data-src="{{ asset('assets/img/rooms/' . $roomInfo->room->featured_img) }}"
                                  alt="Product">
                              </a>
                            </figure>
                            <div class="product-details col-sm-12 col-md-7">
                              <div class="d-flex align-items-center gap-3">
                                @if ($websiteInfo->room_category_status == 1)
                                  <span class="product-tag border radius-sm">
                                    {{ $roomInfo->roomCategory->name }}
                                  </span>
                                @endif
                                <div class="product-price">
                                  <span
                                    class="h6 new-price color-primary">{{ $currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : '' }}
                                    {{ $roomInfo->room->rent }}
                                    {{ $currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : '' }}
                                    / {{ __('Night') }}</span>

                                </div>
                              </div>
                              <h5 class="product-title lc-2 mt-2 mb-15">
                                <a href="{{ route('room_details', ['id' => $roomInfo->room_id, 'slug' => $roomInfo->slug]) }}"
                                  target="_self" title="Link">{{ convertUtf8($roomInfo->title) }}</a>
                              </h5>

                              <ul class="product-icon-list list-unstyled d-flex align-items-center">
                                <li class="icon-start">
                                  <i class="fal fa-bed"></i>
                                  <span>{{ $roomInfo->room->bed }}
                                    {{ $roomInfo->room->bed == 1 ? __('Bed') : __('Beds') }}</span>
                                </li>
                                <li class="icon-start">
                                  <i class="fal fa-bath"></i>
                                  <span>{{ $roomInfo->room->bath }}
                                    {{ $roomInfo->room->bath == 1 ? __('Bath') : __('Baths') }} </span>
                                </li>
                                <li class="icon-start">
                                  <i class="fal fa-user-friends"></i>
                                  <span>{{ $roomInfo->room->max_guests }}
                                    {{ $roomInfo->room->max_guests == 1 ? __('Guest') : __('Guests') }}</span>
                                </li>
                              </ul>
                            </div>
                          </div><!-- product-default -->
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              @endforeach


            </div>
          </div>

          <div class="text-center mt-20 aos-init aos-animate" data-aos="fade-up">
            <a href="{{ route('rooms') }}" class="btn btn-lg btn-primary fancy">{{ __('View All Rooms') }}</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Room latest Section End -->
  @endif

 @if($sections?->featured_services_section == 1)

  <section class="choose-area ptb-100">
    <div class="container">
      <div class="row gx-xl-4 align-items-center">
        <div class="col-lg-6">
          <div class="content mb-40 aos-init aos-animate" data-aos="fade-right">
            @if (!is_null($secHeading))
              <div class="content-title">
                <h2 class="title mb-30">{{ $secHeading->service_section_title }}</h2>
              </div>
              <div class="w-75 w-sm-100">
                <p class="text">{{ $secHeading->service_section_subtitle }}</p>
              </div>
            @endif
            <div class="choose-grid mt-40">
              @foreach ($serviceInfos as $serviceInfo)
                @if ($serviceInfo->service)
                  <div class="grid-item border radius-md p-20">
                    <div class="icon mb-20">
                      @if ($serviceInfo->service->details_page_status == 0)
                        <i class="{{ $serviceInfo->service->service_icon }}"></i>
                      @else
                        <a
                          href="{{ route('service_details', ['id' => $serviceInfo->service_id, 'slug' => $serviceInfo->slug]) }}">
                          <i class="{{ $serviceInfo->service->service_icon }}"></i></a>
                      @endif
                    </div>
                    <h6 class="mb-0 lc-1">{{ $serviceInfo->title }}</h6>
                  </div>
                @endif
              @endforeach

            </div>
          </div>
        </div>
        @if ($sections?->video_section == 1)
          <div class="col-lg-6">
            <div class="image mb-40 img-right aos-init aos-animate" data-aos="fade-left">
              <div class="img-2">
                <img class="blur-up ls-is-cached lazyloaded" src="{{ asset('assets/img/booking-img.jpg') }}"
                  data-src="{{ asset('assets/img/booking-img.jpg') }}" alt="Image">
                <a href="{{ $secHeading->booking_section_button_url }}" class="video-btn youtube-popup p-absolute"
                  title="Play Video">
                  <i class="fas fa-play"></i>
                </a>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>

  @endif

  {{--  Counter --}}
  @if ($sections?->intro_section == 1)
    <div class="counter-area pt-60 pb-30 bg-img lazyloaded"
      data-bg-image="{{ asset('assets/img/intro_section/' . $intro->intro_img) }}"
      style="background-image: url(&quot;{{ asset('assets/img/intro_section/' . $intro->intro_img) }}&quot;); background-size: cover; background-position: center center; display: block;">
      <div class="overlay opacity-75"></div>
      <div class="container">
        <div class="row">
          @if ($sections->statistics_section == 1)
            @if (count($counterInfos) > 0)
              @foreach ($counterInfos as $counterInfo)
                <div class="col-sm-6 col-lg-3 aos-init aos-animate" data-aos="fade-up">
                  <div class="card text-center mb-30">
                    <div class="card-icon color-primary mb-10">
                      <i class="ico-room-inside"></i>
                    </div>
                    <div class="card-content">
                      <span class="h2 mb-1 color-white"><span class="counter">{{ $counterInfo->amount }}</span></span>
                      <p class="card-text font-lg color-medium lh-1">{{ $counterInfo->title }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          @endif

        </div>
      </div>
    </div>
  @endif

  @if ($sections?->testimonials_section == 1)
    <section class="testimonial-area testimonial-1 ptb-100">
      <div class="container">
        <div class="section-title title-inline mb-50 aos-init aos-animate" data-aos="fade-up">
          <h2 class="title">{{ $secHeading->testimonial_section_title }}</h2>
          <!-- Slider navigation buttons -->
          <div class="slider-navigation text-end">
            <button type="button" title="Slide prev" class="slider-btn" id="testimonial-slider-btn-prev">
              <i class="fal fa-angle-left"></i>
            </button>
            <button type="button" title="Slide next" class="slider-btn" id="testimonial-slider-btn-next">
              <i class="fal fa-angle-right"></i>
            </button>
          </div>
        </div>
        <div class="swiper testimonial-slider swiper-initialized swiper-horizontal swiper-pointer-events"
          id="testimonial-slider-1" data-slides-per-view="4">
          <div class="swiper-wrapper" id="swiper-wrapper-fae86b5b0937c48c" aria-live="off"
            style="transform: translate3d(-2311.75px, 0px, 0px); transition-duration: 0ms;">

            @if (count($testimonials) == 0)
              <div class="row text-center">
                <div class="col">
                  <h3 class="text-white">{{ __('No Testimonial Found!') }}</h3>
                </div>
              </div>
            @else
              @foreach ($testimonials as $testimonial)
                <div class="swiper-slide pb-25 aos-init aos-animate" data-aos="fade-up" data-swiper-slide-index="1"
                  role="group" aria-label="2 / 4" style="width: 305.25px; margin-right: 25px;">
                  <div class="slider-item radius-md mt-15">
                    <div class="client p-25">
                      <div class="client-img">
                        <div class="lazy-container rounded-pill ratio ratio-1-1">
                          <img class=" ls-is-cached lazyloaded"
                            src="{{ asset('assets/img/testimonial_section/' . $testimonial->client_image) }}"
                            data-src="assets/images/avatar-2.jpg" alt="Person Image">
                        </div>
                      </div>
                      <div class="content">
                        <h6 class="name mb-1">{{ $testimonial->client_name }}</h6>
                        <span class="designation font-sm">{{ $testimonial->client_designation }}</span>
                      </div>
                    </div>
                    <div class="quote p-25">
                      <span class="icon">
                        <i class="fal fa-quote-right"></i>
                      </span>
                      <p class="text mb-0">
                        {{ $testimonial->comment }}
                      </p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

          </div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
      </div>
    </section>
  @endif

@endsection



@section('theme_scripts')
  @include('frontend.theme_five.include.scripts')
@endsection

@section('script')
  <script src="{{ asset('front/theme_one_two/assets/js/home.js') }}"></script>
@endsection
