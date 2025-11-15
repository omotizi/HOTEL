<div class="profile-setting-section">
    <div class="profile-setting-section__shape">
        <img src="{{ asset(activeTemplate(true) . 'images/shapes/ca-1.png') }}" alt="shape">
    </div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-sm-6">
                <div class="profile-setting">
                    <div class="profile-setting__thumb">
                        <img src="{{ getImage('assets/images/avatar.png') }}" alt="profile Photo">
                    </div>
                    <div class="profile-setting__content">
                        <h6 class="profile-setting__name"> {{ auth()->user()->fullname }} </h6>
                        <p class="profile-setting__text">
                            <a href="mailto:" class="link"> {{ auth()->user()->email }} </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="profile-user-menu">
                    <a class="profile-user-menu__link {{ menuActive('user.home') }}" href="{{ route('user.home') }}"> @lang('My Bookings') </a>
                    <a class="profile-user-menu__link {{ menuActive('user.profile.setting') }}" href="{{ route('user.profile.setting') }}"> @lang('Settings') </a>
                    <a class="profile-user-menu__link {{ menuActive(['ticket.index', 'ticket.open', 'ticket.view']) }}" href="{{ route('ticket.index') }}"> @lang('Support Tickets') </a>
                    <a class="profile-user-menu__link {{ menuActive('user.logout') }}" href="{{ route('user.logout') }}"> @lang('Logout') </a>
                </div>
            </div>
        </div>
    </div>
</div>
