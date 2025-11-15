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
<div class="col-lg-2">
  <!-- Logo -->
  <div class="logo d-none d-xl-flex align-items-center bg-primary h-100 ">
    <a class="navbar-brand" href="{{ route('index') }}" target="_self" title="Link">
      <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="Logo">
    </a>
  </div>
</div>
