
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from html.scriptfusions.com/givewell/main-html/donate-now.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jul 2025 11:24:38 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Donation Now </title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />
    <meta name="description" content="givewell HTML 5 Template " />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/custom-animate.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/swiper.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/font-awesome-all.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/jarallax.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/jquery.magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/odometer.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/nice-select.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/vegas.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/aos.css')}}" />


    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/slider.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/footer.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/about.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/services.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/case.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/donars.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/benefits.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/event.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/video.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/team.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/testimonial.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/blog.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/get-app.css')}}" />
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

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/responsive.css')}}" />
    <style>
    .qr-form-section {
        padding: 50px 0;
    }

    .qr-form__left, .qr-form__right {
        padding: 20px;
    }

    .qr-form__qr-box {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .qr-code img {
        border: 2px solid #ddd;
        border-radius: 5px;
    }

    .donate-amount {
        display: flex;
        gap: 10px;
    }

    .amount-btn, .qr-form__btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .amount-btn:hover, .qr-form__btn:hover {
        background-color: #0056b3;
    }

    .addAmount-value {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .qr-form__payment-list {
        margin-bottom: 20px;
    }

    .custom-radio {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .radio-dot {
        width: 20px;
        height: 20px;
        border: 2px solid #007bff;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        margin-right: 10px;
    }

    .radio-dot::after {
        content: '';
        width: 10px;
        height: 10px;
        background: #007bff;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    input[type="radio"]:checked + .radio-dot::after {
        opacity: 1;
    }

    .qr-form__input-box {
        margin-bottom: 15px;
    }

    .qr-form__input-box input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .qr-form__total-amount {
        margin: 20px 0;
        font-size: 1.2rem;
    }

    .qr-form__btn-box {
        text-align: center;
    }

    .qr-form__img-box {
        position: relative;
        margin-bottom: 20px;
    }

    .qr-form__raised-and-progress {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .qr-form__raised-box {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .doller span {
        font-size: 1.5rem;
        color: #007bff;
    }

    .qr-form__progress .bar {
        width: 100%;
        background: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }

    .bar-inner {
        height: 10px;
        background: #007bff;
        border-radius: 10px;
        position: relative;
    }

    .count-text {
        position: absolute;
        top: -25px;
        right: 0;
        font-size: 0.9rem;
    }

    .qr-form__content {
        padding: 15px;
    }

    .qr-form__client-box {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .qr-form__client-box-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .qr-form__client-img img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
    }

    .qr-form__client-box-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 5px 0;
    }

    .icon span {
        font-size: 1.2rem;
        color: #007bff;
    }
</style>
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="preloader">
        <div class="preloader__image"></div>
    </div>
    <!-- /.preloader -->


      @include('frontend.layouts.form')


    <div class="page-wrapper">

       @include('frontend.layouts.header')

        <div class="stricky-header stricked-menu main-menu main-menu-three">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('frontend/admin/assets/images/backgrounds/page-header-bg.jpg')}});">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <h2>Donation Now</h2>
                    <div class="thm-breadcrumb__box">
                        <ul class="thm-breadcrumb list-unstyled">
                            <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                            <li><span class="icon-right-arrow-1"></span></li>
                            <li>Donation Now</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Donation Now Start-->
       <section class="qr-form-section py-5">
  <div class="contact-block">
    <div class="container">
      <div class="row justify-content-center mb-4">
        <div class="col-lg-12 text-center">
          <h3>Donation Form</h3>
          <p>Welcome to Mansha Educational, Cultural and Social Welfare Society</p>
        </div>
      </div>

      <div class="row g-4">

        @include('frontend.layouts.donationform')

        @include('frontend.layouts.qrcode')

      </div>
    </div>
  </div>
</section>



        <!--Donation Now End-->



        <!--Site Footer Two Start-->
        <footer class="site-footer-two">
              @include('frontend.layouts.footer')
            <div class="site-footer-two__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-footer-two__bottom-inner">
                                <div class="site-footer-two__copyright">
                                     <p class="site-footer-two__copyright-text">© 2025 <a href="#">Webmingo</a>
                                        All
                                        Rights Reserved.</p>
                                </div>
                                <div class="site-footer-two__bottom-menu-box">
                                    <ul class="list-unstyled site-footer-two__bottom-menu">
                                        <li><a href="about.html">Privacy Policy</a></li>
                                        <li><a href="about.html">Terms & Conditions</a></li>
                                        <li><a href="about.html">Customer Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Site Footer Two End-->




    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="assets/images/resources/logo-2.png" width="150"
                        alt="" /></a>
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

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <span class="fas fa-search"></span>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
        <span class="scroll-to-top__text"> Go Back Top</span>
    </a>


    <script src="{{asset('frontend/admin/assets/js/jquery-latest.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jarallax.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.appear.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/wNumb.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/wow.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/isotope.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.circleType.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.fittext.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/jquery.lettering.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/vegas.min.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/aos.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/marquee.min.js')}}"></script>




    <script src="{{asset('frontend/admin/assets/js/gsap/gsap.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/gsap/ScrollTrigger.js')}}"></script>
    <script src="{{asset('frontend/admin/assets/js/gsap/SplitText.js')}}"></script>




    <!-- template js -->
    <script src="{{asset('frontend/admin/assets/js/script.js')}}"></script>
</body>


<!-- Mirrored from html.scriptfusions.com/givewell/main-html/donate-now.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jul 2025 11:24:39 GMT -->
</html>
