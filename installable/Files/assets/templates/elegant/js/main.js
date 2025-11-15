(function ($) {
    ("use strict");

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // ============== Header Hide Click On Body Js Start ========
    $(".header-button").on("click", function () {
        $(".body-overlay").toggleClass("show");
    });
    $(".body-overlay").on("click", function () {
        $(".header-button").trigger("click");
        $(this).removeClass("show");
    });
    // =============== Header Hide Click On Body Js End =========

    // ==========================================
    //      Start Document Ready function
    // ==========================================
    $(document).ready(function () {
        // ========================== Header Hide Scroll Bar Js Start =====================
        $(".navbar-toggler.header-button").on("click", function () {
            $("body").toggleClass("scroll-hide-sm");
        });
        $(".body-overlay").on("click", function () {
            $("body").removeClass("scroll-hide-sm");
        });
        // ========================== Header Hide Scroll Bar Js End =====================

        // ========================== Small Device Header Menu On Click Dropdown menu collapse Stop Js Start =====================
        $(".dropdown-item").on("click", function () {
            $(this).closest(".dropdown-menu").addClass("d-block");
        });
        // ========================== Small Device Header Menu On Click Dropdown menu collapse Stop Js End =====================

        // ========================== Add Attribute For Bg Image Js Start =====================
        $(".bg-img").css("background-image", function () {
            var bg = "url(" + $(this).data("background-image") + ")";
            return bg;
        });
        // ========================== Add Attribute For Bg Image Js End =====================

        // ========================== add active class to ul>li top Active current page Js Start =====================
        function dynamicActiveMenuClass(selector) {
            let fileName = window.location.pathname.split("/").reverse()[0];
            selector.find("li").each(function () {
                let anchor = $(this).find("a");
                if ($(anchor).attr("href") == fileName) {
                    $(this).addClass("active");
                }
            });
            // if any li has active element add class
            selector.children("li").each(function () {
                if ($(this).find(".active").length) {
                    $(this).addClass("active");
                }
            });
            // if no file name return
            if ("" == fileName) {
                selector.find("li").eq(0).addClass("active");
            }
        }
        if ($("ul.sidebar-menu-list").length) {
            dynamicActiveMenuClass($("ul.sidebar-menu-list"));
        }
        // ========================== add active class to ul>li top Active current page Js End =====================

        /*================ datepicker js start here ================*/
        $(".datepicker2").flatpickr({
            dateFormat: "Y-m-d",
            minDate: "today"
        });
        /*================ datepicker js start here ================*/


        //  filter section js 
        $('.total-number').on('click', function (event) {
            event.stopPropagation();
            $('.number-picker').toggleClass('d-block');
        });

        $(document).on('click', function (event) {
            if (!$(event.target).closest('.number-picker, .total-number').length) {
                $('.number-picker').removeClass('d-block');
            }
        });





        /*==================== custom dropdown select js ====================*/
        $('.custom--dropdown > .custom--dropdown__selected').on('click', function () {
            $(this).parent().toggleClass('open');
        });
        $('.custom--dropdown > .dropdown-list > .dropdown-list__item').on('click', function () {
            $('.custom--dropdown > .dropdown-list > .dropdown-list__item').removeClass('selected');
            $(this).addClass('selected').parent().parent().removeClass('open').children('.custom--dropdown__selected').html($(this).html());
        });
        $(document).on('keyup', function (evt) {
            if ((evt.keyCode || evt.which) === 27) {
                $('.custom--dropdown').removeClass('open');
            }
        });
        $(document).on('click', function (evt) {
            if ($(evt.target).closest(".custom--dropdown > .custom--dropdown__selected").length === 0) {
                $('.custom--dropdown').removeClass('open');
            }
        });

        /*=============== custom dropdown select js end =================*/

        // ================== Password Show Hide Js Start ==========
        $(document).on("click", '.toggle-password', function () {
            $(this).toggleClass("fa-eye");
            let input = $(this).siblings('input');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        // =============== Password Show Hide Js End =================

        $(document).ready(function () {

            $('.form--control').on('focus', function () {
                $(this).closest('.form-group').addClass('focused');
            });

            $('.form--control').on('blur', function () {

                if ($(this).val() === '') {
                    $(this).closest('.form-group').removeClass('focused');
                }
            });

        })

        // =========================Gallery magnific Popup Icon Js Start =====================
        $('.gallery-item.popup-thumb').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });



        // ========================= Gallery magnific Popup Icon Js End =====================

        // ========================= Slick Slider Js Start ==============

        $(".booking-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            speed: 1500,
            dots: false,
            pauseOnHover: true,
            arrows: true,
            prevArrow:
                '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
            nextArrow:
                '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        arrows: false,
                        dots: true,
                    }
                }
            ]
        });

        // ========================= Slick Slider Js End ===================

        /*========= swiper slider js =========*/

        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                type: "fraction",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                575: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
            },

        });

        /*================ swiper slider js end here ================*/

        $('.residence-slider').slick({
            centerMode: true,
            slidesToShow: 3,
            variableWidth: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        variableWidth: false,
                        centerPadding: false,
                    }
                }
            ]
        });


        // ========================= Client Slider Js Start ===============

        $('.glance-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            speed: 1500,
            pauseOnHover: true,
            centerMode: true,
            Infinite: true,
            dots: false,
            arrows: true,
            variableWidth: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 1,
                        centerMode: false,
                        variableWidth: false,
                    }
                }
            ]
        });



        // ========================= Client Slider Js End ===================

        $('.testimonial-slider').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 1,
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 1,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        arrows: false,
                        dots: true,
                    }
                }
            ]
        });
        // ========================= facility Slider Js Start ==============
        $(".facility-slider").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            speed: 1500,
            dots: false,
            pauseOnHover: true,
            arrows: true,
            prevArrow:
                '<button type="button" class="slick-prev"><i class="las la-angle-left"></i></button>',
            nextArrow:
                '<button type="button" class="slick-next"><i class="las la-angle-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
        // ========================= facility Slider Js End ===================


        /*====== mega menu js start here ======*/

        var tabSliderCalled = false;
        function tabSlider() {
            $('.room-slider').slick({
                infinite: false,
                speed: 2000,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev"> <i class="las la-arrow-left"></i> </button>',
                nextArrow: '<button type="button" class="slick-next"> <i class="las la-arrow-right"></i> </button>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                            dots: false,
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
            tabSliderCalled = true;
        }

        $('.nav-item').on('mouseenter', function () {
            if ($(this).hasClass('has-mega-menu')) {
                if (!tabSliderCalled) {
                    tabSlider();
                }
            }
        })

        $('.has-mega-menu').click(function (e) {
            e.stopPropagation();
            var $megaMenu = $(this).find('.mega-menu-wrapper');
            $('.mega-menu-wrapper').not($megaMenu).removeClass('show');
            $megaMenu.toggleClass('show');
        });
        /*====== mega menu js end here ======*/

        // room slide js start here 
        $('.category-slider').slick({
            infinite: true,
            speed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            fade: true,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev"> <i class="las la-angle-left"></i> </button>',
            nextArrow: '<button type="button" class="slick-next"> <i class="las la-angle-right"></i> </button>',
        });

        $(document).ready(function () {
            // When hovering over the element with the class '.has-mega-menu'
            $('.has-mega-menu').hover(
                function () {
                    $('.header').addClass('active');
                    $(this).find('.nav-link').addClass('active');

                },
                function () {
                    // On hover out, remove the 'active' class from the 'a' tag inside '.header'
                    $('.header').removeClass('active');
                    $(this).find('.nav-link').removeClass('active');
                }
            );
        });



        // ================== Sidebar Menu Js Start ===============
        // Sidebar Dropdown Menu Start
        $(".has-dropdown > a").click(function () {
            $(".sidebar-submenu").slideUp(200);
            if ($(this).parent().hasClass("active")) {
                $(".has-dropdown").removeClass("active");
                $(this).parent().removeClass("active");
            } else {
                $(".has-dropdown").removeClass("active");
                $(this).next(".sidebar-submenu").slideDown(200);
                $(this).parent().addClass("active");
            }
        });
        // Sidebar Dropdown Menu End
        // Sidebar Icon & Overlay js
        $(".navigation-bar").on("click", function () {
            $(".sidebar-menu").addClass("show-sidebar");
            $(".sidebar-overlay").addClass("show");
        });
        $(".sidebar-menu__close, .sidebar-overlay").on("click", function () {
            $(".sidebar-menu").removeClass("show-sidebar");
            $(".sidebar-overlay").removeClass("show");
        });
        // Sidebar Icon & Overlay js
        // ===================== Sidebar Menu Js End =================

        // ==================== Dashboard User Profile Dropdown Start ==================
        $(".user-info__button").on("click", function () {
            $(".user-info-dropdown").toggleClass("show");
        });
        $(".user-info__button").attr("tabindex", -1).focus();

        $(".user-info__button").on("focusout", function () {
            $(".user-info-dropdown").removeClass("show");
        });
        // ==================== Dashboard User Profile Dropdown End ==================

        // ========================= Odometer Counter Up Js End ==========
        $(".counterup-item").each(function () {
            $(this).isInViewport(function (status) {
                if (status === "entered") {
                    for (
                        var i = 0;
                        i < document.querySelectorAll(".odometer").length;
                        i++
                    ) {
                        var el = document.querySelectorAll(".odometer")[i];
                        el.innerHTML = el.getAttribute("data-odometer-final");
                    }
                }
            });
        });
        // ========================= Odometer Up Counter Js End =====================
    });


    //============== room details slider js start here ==============
    $('.room-details__wrapper').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: true,
        asNavFor: '.room-details__gallery',
        prevArrow: '<button type="button" class="slick-prev gig-details-thumb-arrow"><i class="las la-long-arrow-alt-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next gig-details-thumb-arrow"><i class="las la-long-arrow-alt-right"></i></button>',
    });

    //============== room details slider js end here ==============

    // header active add class js end here 

    $('.room-details__gallery').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.room-details__wrapper',
        dots: false,
        arrows: true,

        focusOnSelect: true,
        prevArrow: '<button type="button" class="slick-prev gig-details-arrow"><i class="las la-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next gig-details-arrow"><i class="las la-arrow-right"></i></button>',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 676,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 460,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
        ]
    });

    //============== room details slider js end here ==============



    // ==========================================
    //      End Document Ready function
    // ==========================================

    // ========================= Preloader Js Start =====================
    $(window).on("load", function () {
        $(".loader").fadeOut();
    });
    // ========================= Preloader Js End=====================

    // // ========================= Header Sticky Js Start ==============
    $(window).on("scroll", function () {
        if ($(window).scrollTop() >= 350) {
            $(".header").addClass("fixed-header");
        } else {
            $(".header").removeClass("fixed-header");
        }
    });

    // // ========================= Header Sticky Js End===================

    // select2 js 
    $(document).ready(function () {
        $('.select2').select2();
    });

    // //============================ Scroll To Top Icon Js Start =========
    var btn = $(".scroll-top");

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass("show");
        } else {
            btn.removeClass("show");
        }
    });

    btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "300");
    });




})(jQuery);
