@php
    $contactContent = getContent('contact_us.content', true);
    $locationContent = getContent('location.content', true);
@endphp
@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="contact-section my-120">
        <div class="container">
            <div class="contact-main-wrapper">
                <div class="shape">
                    <img src="{{ getImage($activeTemplateTrue . 'images/backgrounds/contact_us.png') }}" alt="background">
                </div>
                <div class="row gy-4 align-items-center justify-content-xl-between">
                    <div class="col-lg-7 pe-xl-5">
                        <div class="contact-wrapper__content">
                            <h3 class="contact-wrapper__title"> {{ __($contactContent?->data_values?->heading) }} </h3>
                            <form method="post" class="contact-form-wrapper verify-gcaptcha">
                                @csrf
                                <div class="contact-form-item item-one">
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label class="form--label"> @lang('Name') </label>
                                            <input name="name" type="text" class="form--control form-two" value="{{ old('name', $user?->fullname) }}" @if ($user && $user->profile_complete) readonly @endif required>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="form--label"> @lang('Email') </label>
                                            <input name="email" type="email" class="form--control form-two" value="{{ old('email', $user?->email) }}" @if ($user) readonly @endif required>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class="form--label"> @lang('Subject') </label>
                                            <input name="subject" type="text" class="form--control form-two" value="{{ old('subject') }}" required>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label for="desc" class="form--label">@lang('Message')</label>
                                            <textarea name="message" class="form--control form-two" required>{{ old('message') }}</textarea>
                                        </div>
                                        <x-captcha addClass=form-two />
                                        <div class="col-12">
                                            <button type="submit" class="btn btn--base">@lang('Submit')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 ps-lg-5">
                        <div class="contact-thumb">
                            <img src="{{ frontendImage('contact_us', $contactContent?->data_values?->image, '395x505') }}" alt="contact">
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-location">
                <div class="shape">
                    <img src="{{ getImage($activeTemplateTrue . 'images/backgrounds/location.png') }}" alt="background">
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h3 class="section-heading__title"> {{ __($locationContent?->data_values?->heading) }} </h3>
                            <p class="section-heading__desc"> {{ __($locationContent?->data_values?->subheading) }} </p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="map">
                            <iframe src=" {{ __($locationContent?->data_values?->map_embed_link) }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="contact-item-wrapper">
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-item">
                                <span class="contact-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none">
                                        <path d="M4.74038 14.3685L6.69351 12.9816C7.24445 12.5904 7.80305 12.3282 8.44034 12.1585C9.17201 11.9636 9.5 11.5644 9.5 10.711C9.5 8.54628 14.5 8.31594 14.5 10.711C14.5 11.5644 14.828 11.9636 15.5597 12.1585C16.202 12.3295 16.7599 12.5934 17.3065 12.9816L19.2596 14.3685C20.1434 14.9961 20.5547 15.2995 20.7842 15.7819C21 16.2358 21 16.768 21 17.8324C21 19.7461 21 20.703 20.4642 21.3164C19.8152 22.0593 18.128 21.9955 17.0917 21.9955H6.90833C5.87197 21.9955 4.21909 22.0986 3.5358 21.3164C3 20.703 3 19.7461 3 17.8324C3 16.768 3 16.2358 3.21584 15.7819C3.44526 15.2995 3.85662 14.9961 4.74038 14.3685Z" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M14 17C14 18.1046 13.1046 19 12 19C10.8954 19 10 18.1046 10 17C10 15.8954 10.8954 15 12 15C13.1046 15 14 15.8954 14 17Z" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M6.96014 3.69772C5.6417 4.07415 4.69384 4.54112 3.82645 5.10455C2.45318 5.9966 1.86443 7.60404 2.02607 9.15513C2.09439 9.81068 2.62064 10.1241 3.23089 9.95455C3.69451 9.82571 4.15888 9.7003 4.61961 9.56364C5.96706 9.16397 6.28399 8.67812 6.47124 7.29885L6.96014 3.69772ZM6.96014 3.69772C10.2186 2.76743 13.7814 2.76743 17.0399 3.69772M17.0399 3.69772C18.3583 4.07415 19.3062 4.54112 20.1735 5.10455C21.5468 5.9966 22.1356 7.60404 21.9739 9.15513C21.9056 9.81068 21.3794 10.1241 20.7691 9.95455C20.3055 9.82571 19.8411 9.7003 19.3804 9.56364C18.0329 9.16397 17.716 8.67812 17.5288 7.29885L17.0399 3.69772Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <div class="contact-item__content">
                                    <h5 class="contact-item__title"> @lang('Mobile Number') </h5>
                                    <p class="contact-item__desc">
                                        <a href="tel:{{ $contactContent?->data_values?->contact_number }}">{{ $contactContent?->data_values?->contact_number }} </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-item">
                                <span class="contact-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none">
                                        <path d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M2.01576 13.4756C2.08114 16.5411 2.11382 18.0739 3.24495 19.2093C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.755 19.2093C21.8862 18.0739 21.9189 16.5411 21.9842 13.4756C22.0053 12.4899 22.0053 11.51 21.9842 10.5244C21.9189 7.45883 21.8862 5.92606 20.755 4.79063C19.6239 3.6552 18.0497 3.61565 14.9012 3.53654C12.9607 3.48778 11.0393 3.48778 9.09882 3.53653C5.95033 3.61563 4.37608 3.65518 3.24495 4.79062C2.11382 5.92605 2.08113 7.45882 2.01576 10.5243C1.99474 11.51 1.99474 12.4899 2.01576 13.4756Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                    </svg> </span>
                                <div class="contact-item__content">
                                    <h5 class="contact-item__title"> @lang('Email Address') </h5>
                                    <p class="contact-item__desc">
                                        <a href="mailto:{{ $contactContent?->data_values?->email_address }}">{{ $contactContent?->data_values?->email_address }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-item">
                                <span class="contact-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none">
                                        <path d="M14.5 9C14.5 10.3807 13.3807 11.5 12 11.5C10.6193 11.5 9.5 10.3807 9.5 9C9.5 7.61929 10.6193 6.5 12 6.5C13.3807 6.5 14.5 7.61929 14.5 9Z" stroke="currentColor" stroke-width="1.5" />
                                        <path d="M18.2222 17C19.6167 18.9885 20.2838 20.0475 19.8865 20.8999C19.8466 20.9854 19.7999 21.0679 19.7469 21.1467C19.1724 22 17.6875 22 14.7178 22H9.28223C6.31251 22 4.82765 22 4.25311 21.1467C4.20005 21.0679 4.15339 20.9854 4.11355 20.8999C3.71619 20.0475 4.38326 18.9885 5.77778 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.2574 17.4936C12.9201 17.8184 12.4693 18 12.0002 18C11.531 18 11.0802 17.8184 10.7429 17.4936C7.6543 14.5008 3.51519 11.1575 5.53371 6.30373C6.6251 3.67932 9.24494 2 12.0002 2C14.7554 2 17.3752 3.67933 18.4666 6.30373C20.4826 11.1514 16.3536 14.5111 13.2574 17.4936Z" stroke="currentColor" stroke-width="1.5" />
                                    </svg> </span>
                                <div class="contact-item__content">
                                    <h5 class="contact-item__title"> @lang('Address') </h5>
                                    <p class="contact-item__desc">
                                        {{ __($contactContent?->data_values?->address) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
