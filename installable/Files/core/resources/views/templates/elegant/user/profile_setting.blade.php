@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="reservation-section mb-120">
        <div class="container">
            <div class="row gy-4 flex-column-reverse flex-xl-row">
                <div class="col-xl-8 custom--tab">
                    <ul class="nav nav-pills" id="myTab" role="tablist">
                        <li class="nav-item me-2" role="presentation">
                            <button class="nav-link active" id="profileSetting" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button" role="tab" aria-controls="home"
                                aria-selected="true">@lang('Profile Setting')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="passwordChange" data-bs-toggle="tab" data-bs-target="#password"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="false">@lang('Change Password')</button>
                        </li>
                    </ul>
                    <div class="tab-content border-top mt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                            aria-labelledby="profileSetting">
                            <form action="{{ route('user.submit.profile.setting') }}" class="profile-info" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        <label class="form--label">@lang('First Name')</label>
                                        <input type="text" class="form--control" name="firstname"
                                            value="{{ $user->firstname }}" placeholder="@lang('First Name')" required>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form--label">@lang('Last Name')</label>
                                        <input type="text" class="form--control" name="lastname"
                                            value="{{ $user->lastname }}" placeholder="@lang('Last Name')" required>
                                    </div>

                                    <div class="col-lg-6 form-group">
                                        <label class="form--label">@lang('Address')</label>
                                        <input type="text" class="form--control" name="address"
                                            value="{{ $user->address }}" placeholder="@lang('Your Address')">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form--label">@lang('State')</label>
                                        <input type="text" class="form--control" name="state"
                                            value="{{ $user->state }}" placeholder="@lang('State')">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form--label">@lang('Zip Code')</label>
                                        <input type="text" class="form--control" name="zip"
                                            value="{{ $user->zip }}" placeholder="@lang('Zip Code')">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form--label">@lang('City')</label>
                                        <input type="text" class="form--control" name="city"
                                            value="{{ $user->city }}" placeholder="@lang('City')">
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit"
                                            class="btn btn--lg btn--base w-100">@lang('Submit Changes')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="passwordChange">
                            <form action="{{ route('user.submit.change.password') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form--label">@lang('Current Password')</label>
                                    <div class="position-relative">
                                        <input name="current_password" id="current-password" type="password"
                                            class="form-control form--control" required autocomplete="current-password">
                                        <span class="password-show-hide fas toggle-password fa-eye-slash"
                                            id="#current-password"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form--label">@lang('New Password')</label>
                                    <div class="position-relative">
                                        <input id="new-password" type="password"
                                            class="form-control form--control @if (gs('secure_password')) secure-password @endif"
                                            name="password" required autocomplete="current-password">
                                        <span class="password-show-hide fas toggle-password fa-eye-slash"
                                            id="#new-password"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form--label">@lang('Confirm Password')</label>
                                    <div class="position-relative">
                                        <input id="confirm-password" type="password" class="form-control form--control"
                                            name="password_confirmation" required>
                                        <span class="password-show-hide fas toggle-password fa-eye-slash"
                                            id="#confirm-password"></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn--lg btn--base w-100">@lang('Submit Changes')</button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4">
                    <div class="setting-wrapper pt-xl-4 mt-xl-1">
                        <div class="setting-card">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="d-flex justify-content-between list-group-item mb-2 align-items-start px-0 border-0">
                                    <span class="left-slide">
                                        <svg class="d-inline-block me-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="16" height="16" fill="none">
                                            <path
                                                d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                                stroke="#000000" stroke-width="1.5"></path>
                                            <path
                                                d="M15 10C15 11.6569 13.6569 13 12 13C10.3431 13 9 11.6569 9 10C9 8.34315 10.3431 7 12 7C13.6569 7 15 8.34315 15 10Z"
                                                stroke="#000000" stroke-width="1.5"></path>
                                            <path
                                                d="M5.49994 19.0001L6.06034 18.0194C6.95055 16.4616 8.60727 15.5001 10.4016 15.5001H13.5983C15.3926 15.5001 17.0493 16.4616 17.9395 18.0194L18.4999 19.0001"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="square"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Username')
                                    </span>
                                    <strong class="basic">{{ $user->username }}</strong>
                                </li>
                                <li
                                    class="d-flex justify-content-between list-group-item mb-2 align-items-start px-0 border-0">
                                    <span class="left-slide">
                                        <svg class="d-inline-block me-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="16" height="16" fill="none">

                                            <path
                                                d="M10.5 19H4C2.89543 19 2 18.1046 2 17V5C2 3.89543 2.89543 3 4 3H20C21.1046 3 22 3.89543 22 5V9.5"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M22 6L12.8944 10.5528C12.3314 10.8343 11.6686 10.8343 11.1056 10.5528L2 6"
                                                stroke="#000000" stroke-width="1.5" stroke-linejoin="round">
                                            </path>
                                            <path
                                                d="M20.586 13.331C18.7898 12.3795 17.5 13.7821 17.5 13.7821C17.5 13.7821 16.2102 12.3795 14.4139 13.331C12.2383 14.4834 12.0821 18.9964 17.5 21C22.9179 18.9964 22.7616 14.4834 20.586 13.331Z"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Email Address')
                                    </span>
                                    <strong class="basic">{{ $user->email }}</strong>
                                </li>
                                <li
                                    class="d-flex justify-content-between list-group-item mb-2 align-items-start px-0 border-0">
                                    <span class="left-slide">
                                        <svg class="d-inline-block me-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="16" height="16" fill="none">

                                            <path
                                                d="M10.0808 2C5.47023 2.9359 2 7.01218 2 11.899C2 17.4776 6.52238 22 12.101 22C16.9878 22 21.0641 18.5298 22 13.9192"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round">
                                            </path>
                                            <path
                                                d="M18.9375 18C19.3216 17.9166 19.6771 17.784 20 17.603M14.6875 17.3406C15.2831 17.6015 15.8576 17.7948 16.4051 17.9218M10.8546 14.9477C11.2681 15.238 11.71 15.5861 12.1403 15.8865M3 13.825C3.32234 13.6675 3.67031 13.4868 4.0625 13.3321M6.45105 13C7.01293 13.0624 7.64301 13.2226 8.35743 13.5232"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M18 7.5C18 6.67157 17.3284 6 16.5 6C15.6716 6 15 6.67157 15 7.5C15 8.32843 15.6716 9 16.5 9C17.3284 9 18 8.32843 18 7.5Z"
                                                stroke="#000000" stroke-width="1.5"></path>
                                            <path
                                                d="M17.488 13.6202C17.223 13.8638 16.8687 14 16.5001 14C16.1315 14 15.7773 13.8638 15.5123 13.6202C13.0855 11.3756 9.83336 8.86815 11.4193 5.2278C12.2769 3.25949 14.3353 2 16.5001 2C18.6649 2 20.7234 3.25949 21.5809 5.2278C23.1649 8.86356 19.9207 11.3833 17.488 13.6202Z"
                                                stroke="#000000" stroke-width="1.5"></path>
                                        </svg>
                                        @lang('Country')
                                    </span>
                                    <strong class="basic">{{ $user->country_name }}</strong>
                                </li>
                                <li
                                    class="d-flex justify-content-between list-group-item mb-2 align-items-start px-0 border-0">
                                    <span class="left-slide">
                                        <svg class="d-inline-block me-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="16" height="16" fill="none">

                                            <path
                                                d="M14 16C14 17.1046 13.1046 18 12 18C10.8954 18 10 17.1046 10 16C10 14.8954 10.8954 14 12 14C13.1046 14 14 14.8954 14 16Z"
                                                stroke="#000000" stroke-width="1.5"></path>
                                            <path
                                                d="M7 2.59543C5.80241 2.90007 4.64078 3.43892 3.73907 3.92941C2.61152 4.54275 2 5.76016 2 7.04372V9L5.73468 7.52498C6.49827 7.2234 7 6.48579 7 5.6648V2.59543ZM7 2.59543C10.1211 1.80152 13.8789 1.80152 17 2.59543M17 2.59543C18.1976 2.90007 19.3592 3.43892 20.2609 3.92941C21.3885 4.54275 22 5.76016 22 7.04372V9L18.2653 7.52498C17.5017 7.2234 17 6.48579 17 5.6648V2.59543Z"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M3 20V15.2878C3 14.5035 3.45841 13.7916 4.17239 13.4671L8.5 11.5L8.83922 9.80388C8.93271 9.33646 9.34312 9 9.8198 9H14.1802C14.6569 9 15.0673 9.33646 15.1608 9.80388L15.5 11.5L19.8276 13.4671C20.5416 13.7916 21 14.5035 21 15.2878V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20Z"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Mobile Number')
                                    </span>
                                    <strong class="basic">{{ $user->mobileNumber }}</strong>
                                </li>
                                <li
                                    class="d-flex justify-content-between list-group-item mb-2 align-items-start px-0 border-0">
                                    <span class="left-slide">
                                        <svg class="d-inline-block me-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="16" height="16" fill="none">
                                            <path
                                                d="M22 16.5C22 20 17.5 22 17.5 22C17.5 22 13 20 13 16.5C13 14.0147 15.0147 12 17.5 12C19.9853 12 22 14.0147 22 16.5Z"
                                                stroke="#000000" stroke-width="1.5"></path>
                                            <path
                                                d="M11 14.5C9.067 14.5 7.5 12.933 7.5 11C7.5 9.067 9.067 7.5 11 7.5C12.7533 7.5 14.2056 8.78927 14.4604 10.4715"
                                                stroke="#000000" stroke-width="1.5"></path>
                                            <path
                                                d="M19.9662 10.2147C19.5684 5.61188 15.706 2 11 2C6.02944 2 2 6.02944 2 11C2 18 11 22 11 22C11 22 11.6605 21.7065 12.6235 21.1393"
                                                stroke="#000000" stroke-width="1.5"></path>
                                            <path d="M17.5 16.5H17.509" stroke="#000000" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Address')
                                    </span>
                                    <strong class="basic">{{ $user->address }}</strong>
                                </li>
                                <li
                                    class="d-flex justify-content-between list-group-item mb-2 align-items-start px-0 border-0">
                                    <span class="left-slide">
                                        <svg class="d-inline-block me-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="16" height="16" fill="none">

                                            <path d="M6.5 9H8.5" stroke="#000000" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.5 8V4C17.5 2.89543 18.3954 2 19.5 2" stroke="#000000"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M12.5 18L12.5 22" stroke="#000000" stroke-width="1.5"
                                                stroke-linecap="round"></path>
                                            <path
                                                d="M17.5 5.15889C16.5351 5 15.2591 5 13.375 5H10.625C7.70671 5 6.24757 5 5.14302 5.59039C4.27088 6.05656 3.55656 6.77088 3.09039 7.64302C2.5 8.74757 2.5 10.2067 2.5 13.125C2.5 14.876 2.5 15.7515 2.85424 16.4142C3.13394 16.9375 3.56253 17.3661 4.08581 17.6458C4.74854 18 5.62403 18 7.375 18H16.625C18.376 18 19.2515 18 19.9142 17.6458C20.4375 17.3661 20.8661 16.9375 21.1458 16.4142C21.5 15.7515 21.5 14.876 21.5 13.125C21.5 10.2067 21.5 8.74757 20.9096 7.64302C20.7356 7.31755 20.5271 7.01406 20.2887 6.73725"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round">
                                            </path>
                                            <path
                                                d="M12.5006 18V11C12.5006 10.071 12.5006 9.60649 12.439 9.21782C12.1002 7.07836 10.4222 5.40041 8.28276 5.06155C8.2009 5.04859 8.11566 5.03835 8.02344 5.03027"
                                                stroke="#000000" stroke-width="1.5" stroke-linecap="round">
                                            </path>
                                        </svg>
                                        @lang('Zip Code')
                                    </span>
                                    <strong class="basic">{{ $user->zip ? $user->zip : '-----' }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        (function($) {
            'use strict';

            const activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#' + activeTab).click();
            }

            $('.nav-item').on('click', function() {
                let activeTabId = $(this).find('.nav-link').attr('id');
                if (activeTabId != activeTab) localStorage.setItem('activeTab', activeTabId);
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .basic-wrapper .basic {
            font-size: 19px;
            line-height: 1;
            color: hsl(var(--black) / 0.9);
        }

        .tab-pane {
            padding: 30px 0;
        }
    </style>
@endpush
