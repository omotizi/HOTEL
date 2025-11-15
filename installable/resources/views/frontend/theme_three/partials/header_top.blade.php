<!-- Start mobile menu -->
<div class="mobile-menu">
  <div class="container">
    <div class="mobile-menu-wrapper"></div>
  </div>
</div>
<!-- End mobile menu -->

<div class="main-responsive-nav">
  <div class="container">
    <!-- Mobile Logo -->
    <div class="logo">
      <a href="{{ route('index') }}">
        <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="logo" width="64%">
      </a>
    </div>
    <!-- Menu toggle button -->
    <button class="menu-toggler" type="button">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</div>
<div class="header-top pt-15">
  <div class="row align-items-center">
    <div class="col-lg-6 col-6">
      <div class="header-left mb-15">
        <ul class="list-unstyled d-flex align-items-center gap-3">
          @if (!is_null($websiteInfo->address))
            <li class="icon-start border-end pe-3">
              <a target="_self" title="{{ $websiteInfo->address }}">
                {{ $websiteInfo->address }}
              </a>
            </li>
          @endif
          @if (!is_null($websiteInfo->support_contact))
            <li class="icon-start">
              <a href="tel:{{ $websiteInfo->support_contact }}" target="_self">
                <i class="fal fa-user-headset"></i>{{ $websiteInfo->support_contact }}
              </a>
            </li>
          @endif
        </ul>
      </div>
    </div>
    @if (count($socialLinkInfos) > 0)
      <div class="col-lg-6 {{ $currentLanguageInfo->direction == 1 ? 'text-start' : 'text-end' }} col-6">
        <div class="header-right mb-15">
          <div class="social-link size-md">
            @foreach ($socialLinkInfos as $socialLinkInfo)
              <a class="rounded-pill" href="{{ $socialLinkInfo->url }}" target="_blank" t><i
                  class="{{ $socialLinkInfo->icon }}"></i></a>
            @endforeach
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
