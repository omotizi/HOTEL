@php
  $primaryColor = $websiteInfo->primary_color;
  $secondaryColor = $websiteInfo->secondary_color;
  $breadcrumbOverlayColor = $websiteInfo->breadcrumb_overlay_color;
  $breadcrumbOverlayOpacity = $websiteInfo->breadcrumb_overlay_opacity;

  // check, whether color has '#' or not, will return 0 or 1
  function checkColorCode($color)
  {
    return preg_match('/^#[a-f0-9]{6}/i', $color);
  }

  // if, primary color value does not contain '#', then add '#' before color value
  if (isset($primaryColor) && checkColorCode($primaryColor) == 0) {
    $primaryColor = '#' . $primaryColor;
  }

  // if, secondary color value does not contain '#', then add '#' before color value
  if (isset($secondaryColor) && checkColorCode($secondaryColor) == 0) {
    $secondaryColor = '#' . $secondaryColor;
  }

  // if, breadcrumb overlay color value does not contain '#', then add '#' before color value
  if (isset($breadcrumbOverlayColor) && checkColorCode($breadcrumbOverlayColor) == 0) {
    $breadcrumbOverlayColor = '#' . $breadcrumbOverlayColor;
  }

  // change decimal point into hex value for opacity
  $decimalVal = round($breadcrumbOverlayOpacity * 255);
  $hexVal = dechex($decimalVal);
@endphp

<style>
  .home-two .menu-right-area a {
    color: {{ $secondaryColor }};
  }

  .home-two .menu-right-area .main-menu li.have-submenu::after {
    color: {{ $secondaryColor }};
  }

  .loader>span {
    background: {{ $primaryColor }};
  }

  .header-top-area .top-contact-info i {
    color: {{ $primaryColor }};
  }

  .header-top-area a:hover {
    color: {{ $primaryColor }};
  }

  .header-menu-area {
    background-color: {{ $secondaryColor }};
  }

  .home-two .header-top-area {
    background-color: {{ $secondaryColor }};
  }

  .menu-right-area .lang-select .nice-select {
    background: {{ $secondaryColor }};
  }

  .packages-area-v1 .packages-post-item h3.title:hover {
    color: {{ $primaryColor }};
  }

  .home-two .menu-right-area .lang-select .nice-select {
    color: {{ $secondaryColor }};
  }

  .home-two .menu-right-area .lang-select .nice-select::after {
    color: {{ $secondaryColor }};
  }

  .menu-right-area .lang-select .nice-select .list li:hover {
    background-color: {{ $secondaryColor }};
  }

  .menu-right-area .main-menu li.active-page>a,
  .menu-right-area .main-menu li.active-page.have-submenu::after,
  .menu-right-area .main-menu li.have-submenu:hover::after {
    color: {{ $primaryColor }};
  }

  .menu-right-area a:hover {
    color: {{ $primaryColor }};
  }

  .menu-right-area .main-menu li .submenu li a:hover {
    background-color: {{ $secondaryColor }};
  }

  .btn {
    background-color: {{ $primaryColor }};
  }

  .btn.filled-btn:hover {
    background-color: {{ $secondaryColor }};
  }

  .input-wrap i {
    color: {{ $primaryColor }};
  }

  .nice-select:after {
    color: {{ $primaryColor }};
  }

  .title-gallery .title-gallery-content {
    background-color: {{ $primaryColor }};
  }

  .section-title span.title-top.with-border::before {
    background: {{ $primaryColor }};
  }

  .section-title span.title-top {
    color: {{ $primaryColor }};
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    color: {{ $secondaryColor }};
  }

  span.counter-number,
  .fact-num {
    color: {{ $secondaryColor }};
  }

  .counter .counter-box i {
    color: {{ $primaryColor }};
  }

  .single-service-box .service-icon i {
    color: {{ $primaryColor }};
  }

  .latest-room::after {
    background-color: {{ $secondaryColor }};
  }

  .room-arrows span.slick-arrow:hover {
    background-color: {{ $primaryColor }};
  }

  .single-room .room-desc .room-cat,
  .single-room .room-price {
    background-color: {{ $primaryColor }};
  }

  .single-room .room-desc h4 a {
    color: {{ $secondaryColor }};
  }

  .single-room .room-desc h4 a:hover {
    color: {{ $primaryColor }};
  }

  .single-room .room-desc .room-info i {
    color: {{ $primaryColor }};
  }

  .single-service-box:hover {
    background-color: {{ $primaryColor }};
    border-color: {{ $primaryColor }};
  }

  .single-service-box:hover .service-counter {
    color: {{ $primaryColor }};
  }

  .cta-section::after {
    background-color: {{ $secondaryColor }};
  }

  .cta-section .video-icon a {
    color: {{ $primaryColor }};
  }

  .gallery-box:hover::before {
    border-color: {{ $primaryColor }};
  }

  .gallery-box::after {
    background-color: {{ $secondaryColor }};
  }

  .feature-left .feature-list li .feature-icon {
    background-color: {{ $primaryColor }};
  }

  .feature-img .feature-abs-con {
    background-color: {{ $primaryColor }};
  }

  .feature-img:after {
    background-color: {{ $secondaryColor }};
  }

  .feedback-section {
    background-color: {{ $secondaryColor }};
  }

  .feedback-section .feadback-slide .single-feedback-box:hover::before {
    border-color: {{ $primaryColor }};
  }

  .feedback-section .feadback-slide .single-feedback-box .feedback-author::before {
    background-color: {{ $primaryColor }};
  }

  .feedback-section .feadback-slide ul.slick-dots li.slick-active button {
    border-color: {{ $primaryColor }};
  }

  .feedback-section .feadback-slide ul.slick-dots li button::before {
    background-color: {{ $primaryColor }};
  }

  .primary-bg {
    background-color: {{ $primaryColor }};
  }

  .back-top .back-to-top {
    background: {{ $primaryColor }};
  }

  footer {
    background-color: {{ $secondaryColor }};
  }

  footer .widget.footer-widget ul.nav-widget li a:hover {
    color: {{ $primaryColor }};
  }

  footer .widget.footer-widget ul.nav-widget li a::before {
    background: {{ $primaryColor }};
  }

  footer .footer-bottom .footer-nav li:hover a {
    color: {{ $primaryColor }};
  }

  .breadcrumb-area .breadcrumb-content li a {
    color: {{ $primaryColor }};
  }

  .filter-view ul li.active-f-view a,
  .filter-view ul li:hover a {
    color: {{ $primaryColor }};
  }

  .filter-view ul li::after {
    background-color: {{ $primaryColor }};
  }

  .pagination-wrap li a {
    background-color: {{ $secondaryColor }};
  }

  .pagination-wrap li a:hover {
    background-color: {{ $primaryColor }};
  }

  .pagination-wrap li.active a {
    background-color: {{ $primaryColor }};
  }

  .sidebar-wrap .widget .widget-title::after,
  .sidebar-wrap .widget .widget-title::before {
    background-color: {{ $primaryColor }};
  }

  .sidebar-wrap .widget.fillter-widget .slider-range .ui-widget-header {
    background: {{ $primaryColor }};
  }

  .sidebar-wrap .widget.fillter-widget .slider-range .ui-slider.ui-slider-horizontal.ui-widget.ui-widget-content.ui-corner-all {
    border-color: {{ $primaryColor }};
  }

  .sidebar-wrap .widget.fillter-widget .slider-range span.ui-slider-handle.ui-state-default.ui-corner-all {
    border: {{ '1px solid ' . $primaryColor }};
    background: {{ $primaryColor }};
  }

  .post-thumb .price-tag {
    background-color: {{ $primaryColor }};
  }

  .packages-big-slider .slick-arrow {
    background: {{ $secondaryColor }};
  }

  .packages-big-slider .slick-arrow:hover {
    background-color: {{ $primaryColor }};
  }

  .room-details-wrapper .main-slider .slick-arrow {
    background: {{ $secondaryColor }};
  }

  .room-details-wrapper .main-slider .slick-arrow:hover {
    background-color: {{ $primaryColor }};
  }

  .room-cat a {
    background-color: {{ $primaryColor }};
  }

  .entry-meta li i {
    color: {{ $primaryColor }};
  }

  .room-details-wrapper .room-details-tab .nav.desc-tab-item li a.nav-link.active,
  .room-details-wrapper .room-details-tab .nav.desc-tab-item li a.nav-link:hover {
    color: {{ $primaryColor }};
    border-color: {{ $primaryColor }};
  }

  .comment-area .comment-list li .comment-desc a.reply-comment:hover {
    color: {{ $primaryColor }};
  }

  .room-details-wrapper .room-details-tab .review-form button:hover {
    background: {{ $secondaryColor }};
  }

  .sidebar-wrap .widget.booking-widget .widget-title {
    background-color: {{ $primaryColor }};
  }

  .sidebar-wrap .widget.category-widget .single-cat a:hover {
    color: {{ $primaryColor }};
  }

  .single-service-box.service-white-bg:hover .service-counter {
    color: {{ $primaryColor }};
  }

  .single-service-box.service-white-bg:hover {
    background-color: {{ $primaryColor }};
    border-color: {{ $primaryColor }};
  }

  .feedback-slider-two ul.slick-dots li button::before {
    background-color: {{ $primaryColor }};
  }

  .feedback-slider-two ul.slick-dots li.slick-active button {
    border-color: {{ $primaryColor }};
  }

  .service-details-section .service-sidebar .widgets h4.widget-title:before,
  .service-details-section .service-sidebar .widgets h4.widget-title:after {
    background-color: {{ $primaryColor }};
  }

  .service-details-section .service-sidebar .service-cat .service-cat-list li a:hover,
  .service-details-section .service-sidebar .service-cat .service-cat-list li a:focus {
    background-color: {{ $primaryColor }};
  }

  .single-blog-wrap .post-thumbnail::before {
    background: {{ $secondaryColor }};
  }

  .single-blog-wrap .blog-meta li i {
    color: {{ $primaryColor }};
  }

  .single-blog-wrap h3 a {
    color: {{ $secondaryColor }};
  }

  .sidebar-wrap .widget.search-widget {
    background-color: {{ $primaryColor }};
  }

  .sidebar-wrap .widget.recent-news li .recent-post-desc h6 a {
    color: {{ $secondaryColor }};
  }

  .sidebar-wrap .widget.recent-news li .recent-post-desc h6 a:hover {
    color: {{ $primaryColor }};
  }

  .comment-title::after,
  .comment-title::before,
  .comment-form-title::after,
  .comment-form-title::before {
    background-color: {{ $primaryColor }};
  }

  .gallery-filter li {
    color: {{ $secondaryColor }};
  }

  .gallery-filter li:before {
    color: {{ $primaryColor }};
  }

  .gallery-filter li:hover,
  .gallery-filter li.active {
    color: {{ $primaryColor }};
  }

  .gallery-items .gallery-item::before {
    background-color: {{ $secondaryColor }};
  }

  .packages-sidebar .widget h4.widget-title:before,
  .packages-sidebar .widget h4.widget-title:after {
    background-color: {{ $primaryColor }};
  }

  input,
  select,
  textarea,
  .nice-select {
    color: {{ $secondaryColor }};
  }

  .packages-area-v1 .packages-sidebar .widget.price_ranger_widget .ui-widget .ui-slider-handle {
    background: {{ $primaryColor }};
  }

  .packages-area-v1 .packages-sidebar .widget.price_ranger_widget .ui-widget .ui-widget-header {
    background: {{ $primaryColor }};
  }

  .packages-area-v1 .packages-post-item .entry-content .post-meta ul li span i,
  .ma-package-section .packages-post-item .entry-content .post-meta ul li span i {
    color: {{ $primaryColor }};
  }

  .packages-details-area .packages-details-wrapper .box-wrap h4.title:after {
    background-color: {{ $primaryColor }};
  }

  .packages-details-area .packages-details-wrapper .schedule-wrapp .single-schedule .icon i {
    background-color: {{ $primaryColor }};
  }

  .packages-details-area .packages-sidebar .information-widget ul.list li:before {
    color: {{ $primaryColor }};
  }

  .feature-accordion .card .card-header button:hover,
  .feature-accordion .card .card-header button.active-accordion {
    background-color: {{ $primaryColor }};
  }

  .feature-accordion .card .card-header button {
    color: {{ $secondaryColor }};
  }

  .contact-info-section .contact-info-box .contact-icon {
    background-color: {{ $primaryColor }};
  }

  .contact-info-section .contact-info-box:hover .contact-icon {
    background-color: {{ $secondaryColor }};
  }

  .contact-form h2.form-title::after {
    background: {{ $primaryColor }};
  }

  .user-dashboard .user-sidebar .links li a:hover,
  .user-dashboard .user-sidebar .links li.active-menu>a {
    color: {{ $primaryColor }};
  }

  .user-dashboard .main-table .dataTables_wrapper td a.btn {
    border: {{ '1px solid ' . $primaryColor }};
  }

  .user-dashboard .main-table .dataTables_wrapper td a.btn:hover {
    background: {{ $primaryColor }};
  }

  .user-dashboard .main-table .dataTables_wrapper .dataTables_paginate .paginate_button.active .page-link {
    background-color: {{ $primaryColor . ' !important' }};
  }

  .user-dashboard .main-table .dataTables_wrapper .dataTables_paginate .paginate_button .page-link:hover {
    background-color: {{ $primaryColor . ' !important' }};
  }

  .user-dashboard .view-order-page .order-info-area .print .btn {
    background: {{ $primaryColor }};
  }

  .user-dashboard .user-profile-details .edit-info-area .file-upload-area span {
    background: {{ $primaryColor }};
  }

  .user-dashboard .user-profile-details .edit-info-area .btn {
    background: {{ $primaryColor }};
  }

  .hero-section.slider-two .slick-arrow:hover {
    color: {{ $primaryColor }};
  }

  .hero-section.slider-two ul.slick-dots li button::before {
    background-color: {{ $primaryColor }};
  }

  .hero-section.slider-two ul.slick-dots li.slick-active button {
    border-color: {{ $primaryColor }};
  }

  .btn.btn-black {
    background-color: {{ $secondaryColor }};
  }

  .single-feature-box .feature-icon::before {
    background: {{ $primaryColor }};
  }

  .latest-room {
    background-color: {{ $secondaryColor }};
  }

  .latest-room .shape-three {
    background-color: {{ $primaryColor }};
  }

  .room-box .room-content i {
    color: {{ $primaryColor }};
  }

  .feedback-slider-two .client-name .client-job {
    color: {{ $primaryColor }};
  }

  .single-latest-blog .latest-blog-desc .post-date i {
    color: {{ $primaryColor }};
  }

  .packages-details-area .packages-details-wrapper .places-box a:hover {
    background-color: {{ $primaryColor }};
  }

  .search-widget ul.categories li:hover::before,
  .search-widget ul.categories li:hover a,
  .search-widget ul.categories li.active::before,
  .search-widget ul.categories li.active a {
    color: {{ $primaryColor }};
  }

  .single-feature-box .feature-icon i {
    color: {{ $primaryColor }};
  }

  .sidebar-wrap .widget.category-widget ul li:hover a,
  .sidebar-wrap .widget.category-widget ul li:hover::before,
  .sidebar-wrap .widget.category-widget ul li.active::before,
  .sidebar-wrap .widget.category-widget ul li.active a {
    color: {{ $primaryColor }};
  }

  button.cookie-consent__agree {
    background-color: {{ $primaryColor }};
  }

  .error-txt a {
    background-color: {{ $primaryColor }};
    border: {{ '1px solid ' . $primaryColor }};
  }

  .error-txt a:hover {
    color: {{ $primaryColor }};
  }

  footer .widget.footer-widget .recent-post li::before {
    color: {{ $primaryColor }};
  }

  .breadcrumb-area::after {
    background-color: {{ $breadcrumbOverlayColor . $hexVal }};
  }
</style>
