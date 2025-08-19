<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> jaimansha </title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/admin/assets/images/jaimansa-logo.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frontend/admin/assets/images/jaimansa-logo.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('frontend/admin/assets/images/jaimansa-logo.png') }}" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="givewell HTML 5 Template " />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;display=swap"
        rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&amp;display=swap"
        rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&amp;display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/custom-animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/font-awesome-all.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/owl.theme.default.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/nice-select.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/vegas.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/aos.css') }}" />

    <!-- Module CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/about.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/services.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/case.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/donars.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/benefits.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/event.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/video.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/team.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/testimonial.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/blog.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/module-css/get-app.css') }}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/feature.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/faq.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/helping-hand.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/gallery.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/donate.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/brand.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/join-one.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/contact.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/pricing.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/need-help.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/page-header.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/counter.css')}}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/admin/assets/css/responsive.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .custom-dropdown {
        position: relative;
    }

    .custom-dropdown .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: -100px;
        background: #fff;
        list-style: none;
        margin: 0;
        padding: 0;
        border: 1px solid #ddd;
        z-index: 999;
        min-width: 300px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-dropdown .dropdown-menu li a {
        display: block;
        width: 100%;
        padding: 8px 12px;
        color: #333;
        text-decoration: none;
    }

    .custom-dropdown .dropdown-menu li a:hover {
        width: 100%;
        background-color: #f0f0f0;
    }

    /* Show on hover */
    .custom-dropdown:hover .dropdown-menu {
        display: block;
    }

    .arrow {
        font-size: 0.7em;
        margin-left: 5px;
    }
</style>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="preloader">
        <div class="preloader__image"></div>
    </div>
    <!-- /.preloader -->

    @if (request()->routeIs('frontend.home'))
        <a href="{{ route('frontend.donate_us') }}" class="donate-now-btn" style="font-size:18px;">Donate Now</a>
        <div class="chat-icon"><button type="button" class="chat-toggler"> Jaimansha India Trust</button></div>
    @endif

    @include('frontend.layouts.form')

 @stack('after-scripts')
    <div class="page-wrapper">
        @include('frontend.layouts.header')

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        <!-- ----------------------------------------------main section is start ------------------------------------- -->

        @yield('content')


        <!--11  Footer Start-->
        @include('frontend.layouts.footer')
        <div class="site-footer-two__bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="site-footer-two__bottom-inner">
                            <div class="site-footer-two__copyright">
                                <p class="site-footer-two__copyright-text">© 2025 Mansha Educational, Cultural, and
                                    Social Welfare Society All Rights Reserved.</p>
                            </div>
                            <div class="site-footer-two__bottom-menu-box">
                                <p class="site-footer-two__copyright-text">Website Designed & Maintained by <a href="">
                                        Web Mingo</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="admin/assets/images/jaimansa-logo.png"
                        width="150" alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:needhelp@packageName__.com">needhelp@givewell.com</a>
                </li>
                <li>
                    <i class="fas fa-phone"></i>
                    <a href="tel:666-888-0000">666 888 0000</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-facebook-square"></a>
                    <a href="#" class="fab fa-pinterest-p"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <!-- Search Popup -->
    <div class="search-popup">
        <div class="color-layer"></div>
        <button class="close-search"><span class="far fa-times fa-fw"></span></button>
        <form method="post" action="https://html.scriptfusions.com/givewell/main-html/blog.html">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here" required="">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- End Search Popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
        <span class="scroll-to-top__text"> Go Back Top</span>
    </a>


    <script src="{{ asset('frontend/admin/assets/js/jquery-latest.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/wNumb.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jquery-ui.js') }}"></script>
    <!-- <script src="{{ asset('frontend/admin/assets/js/jquery.nice-select.min.js') }}"></script> -->
    <script src="{{ asset('frontend/admin/assets/js/jquery.circleType.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jquery.fittext.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/vegas.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/marquee.min.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/typed-2.0.11.js') }}"></script>

    <script src="{{ asset('frontend/admin/assets/js/gsap/gsap.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/gsap/ScrollTrigger.js') }}"></script>
    <script src="{{ asset('frontend/admin/assets/js/gsap/SplitText.js') }}"></script>

    <script src="{{ asset('frontend/admin/assets/js/script.js') }}"></script>

</body>


<!-- Mirrored from html.scriptfusions.com/givewell/main-html/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jul 2025 11:22:26 GMT -->

</html>