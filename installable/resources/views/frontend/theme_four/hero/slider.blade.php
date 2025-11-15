 <section class="hero-banner hero-banner-3">
   <div class="container-fluid">
     <div class="swiper home-slider" id="home-slider-3">
       <div class="swiper-wrapper">
         @if (count($sliders) != 0)
           @foreach ($sliders as $slider)
             <div class="swiper-slide text-center" data-aos="fade-up">
               <div class="banner-content">
                 <h1 class="title color-white mb-25" data-animation="animate__fadeInUp" data-delay=".1s">
                   {{ convertUtf8($slider->title) }}</h1>
                 <p class="text" data-animation="animate__fadeInUp" data-delay=".2s">
                   {{ convertUtf8($slider->subtitle) }}</p>
               </div>
             </div>
           @endforeach
         @else
           <div class="bg-light pt-70 pb-130 text-center">
             <h3>{{ __('No Slider Found!') }}</h4>
           </div>
         @endif
       </div>
     </div>
     @if ($sections?->search_section == 1)
       <div class="banner-filter-form mt-40 mx-auto" data-aos="fade-up" data-aos-delay="100">
         <div class="form-wrapper p-30 radius-lg">
           <form action="{{ route('rooms') }}" method="GET">
             <div class="row align-items-center gx-xl-3">
               <div class="col-lg-10">
                 <div class="row">
                   <div class="col-lg-5 col-md-4 col-sm-5">
                     <div class="form-group {{ $currentLanguageInfo->direction == 1 ? 'border-start' : 'border-end' }}">
                       <label for="guest" class="font-sm">{{ __('Check In / Out Date') }}</label>
                       <div class="form-block">
                         <div class="icon color-white"><i class="fas fa-calendar-alt"></i></div>
                         <input type="text" placeholder="{{ __('Check In / Out Date') }}" class="form-control"
                           name="dates" id="date-range" autocomplete="off">
                       </div>
                     </div>
                   </div>

                   <div class="col-lg-2">
                     <div class="form-group {{ $currentLanguageInfo->direction == 1 ? 'border-start' : 'border-end' }}">
                       <label for="guest" class="font-sm">{{ __('Baths') }}</label>
                       <div class="input-wrap">
                         <select name="baths" class="niceselect">
                           <option selected value="">{{ __('Baths') }}</option>
                           @for ($i = 1; $i <= $numOfBath; $i++)
                             <option value="{{ $i }}">{{ $i }}</option>
                           @endfor
                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-lg-2">
                     <div class="form-group {{ $currentLanguageInfo->direction == 1 ? 'border-start' : 'border-end' }}">
                       <label for="guest" class="font-sm">{{ __('Beds') }}</label>
                       <div class="input-wrap">
                         <select name="beds" class="niceselect">
                           <option selected>{{ __('Beds') }}</option>
                           @for ($i = 1; $i <= $numOfBed; $i++)
                             <option value="{{ $i }}">{{ $i }}</option>
                           @endfor
                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-lg-2 col-md-2 col-sm-5">
                     <div class="form-group {{ $currentLanguageInfo->direction == 1 ? '' : 'border-end' }}">
                       <label for="guest" class="font-sm">{{ __('Guest') }}</label>
                       <div class="input-wrap">
                         <select name="guests" class="niceselect">
                           <option selected value="">{{ __('Guests') }}</option>

                           @for ($i = 1; $i <= $numOfGuest; $i++)
                             <option value="{{ $i }}">{{ $i }}</option>
                           @endfor
                         </select>
                       </div>
                     </div>
                   </div>

                 </div>
               </div>
               <div class="col-lg-2 col-sm-3 text-end">
                 <button type="submit" class="btn btn-icon bg-primary color-white radius-md" aria-label="Search">
                   <i class="fal fa-search"></i>
                 </button>
               </div>
             </div>
           </form>
         </div>
       </div>
     @endif
     <div class="swiper-pagination position-static mt-40" id="home-slider-2-pagination" data-aos="fade-up"
       data-aos-delay="100"></div>
   </div>
   @if (count($sliders) != 0)
     <div class="swiper home-img-slider" id="home-img-slider-2">
       <div class="swiper-wrapper">
         @foreach ($sliders as $slider)
           <div class="swiper-slide">
             <div class="lazyload bg-img" data-bg-image="{{ asset('assets/img/hero_slider/' . $slider->img) }}"></div>
           </div>
         @endforeach
       </div>
     </div>
   @endif
 </section>
