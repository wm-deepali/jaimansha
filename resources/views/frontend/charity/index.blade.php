<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from html.scriptfusions.com/givewell/main-html/Volunteers.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jul 2025 11:24:25 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>  </title>
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
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/counter.css')}}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/responsive.css')}}" />

    <style>
        /* Volunteer form container */
.form-wrapper {
    background: #fff;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    margin-bottom: 40px;
}

.form-wrapper:hover {
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

/* Form labels */
.form-wrapper label {
    font-weight: 600;
    color: #2c3e50;
}

/* Inputs, selects, textareas */
.form-wrapper .form-control,
.form-wrapper .form-select {
    border-radius: 8px;
    border: 1.4px solid #ced4da;
    padding: 10px 14px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-wrapper .form-control:focus,
.form-wrapper .form-select:focus {
    border-color: #0d6efd;
    box-shadow: none;
}

/* Textarea placeholders */
.form-wrapper textarea::placeholder {
    color: #6c757d;
    opacity: 1;
}

/* Submit button */
.form-wrapper button.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-weight: 600;
    padding: 12px 50px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
}

.form-wrapper button.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0b5ed7;
    box-shadow: 0 8px 25px rgba(11, 94, 215, 0.4);
}

/* Responsive fix for small devices */
@media (max-width: 576px) {
    .form-wrapper {
        padding: 20px 15px;
    }
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


    <div class="chat-icon"><button type="button" class="chat-toggler"><i class="fa fa-comment"></i></button></div>
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
                    <h2>Charity</h2>
                    <div class="thm-breadcrumb__box">
                        <ul class="thm-breadcrumb list-unstyled">
                            <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
                            <li><span class="icon-right-arrow-1"></span></li>
                            <li>Charity</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!--Page Header  End-->
<section class="services-one">
    <!-- <div class="services-one__bg" style="background-image: url({{ asset('frontend/admin/assets/images/backgrounds/services-one-bg.jpg') }});"> -->
    </div>
    <div class="container">
        <div class="row">

            <div class="col-xl-8 col-lg-7">
                <div class="services-one__right">
                    <div class="services-one__carousel owl-theme owl-carousel">
                        @foreach($donates as $donate)
                        <div class="item">
                            <div class="services-one__single">
                                <h3 class="services-one__title">
                                    <a href="#">{{ $donate->title }}</a>
                                </h3>

                                <div class="services-one__title-shape">
                                    <img src="{{ asset('frontend/admin/assets/images/shapes/services-one-title-shape.png') }}" alt="">
                                </div>

                                <p class="services-one__text">{!! $donate->description !!}</p>

                                <div class="services-one__img-box">
                                    <div class="services-one__img">
                                        <img src="{{ asset('public/uploads/donate/' . $donate->image) }}" alt="Donate Image" width="200">
                                    </div>

                                    <div class="services-one__icon-inner">
                                        <div class="services-one__icon">
                                            <span class="icon-mortarboard"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="services-one__read-more">

<a href="{{ route('frontend.charity_details.index', ['slug' => $donate->slug]) }}">Read More</a>


                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    <!-- </div> -->
</section>


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


<!-- Mirrored from html.scriptfusions.com/givewell/main-html/Volunteers.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jul 2025 11:24:27 GMT -->
</html>
