<!-- Banner One Start -->
<section class="banner-one">
    <div class="banner-one__bg" style="background-image: url({{ asset('frontend/admin/assets/images/backgrounds/banner-one-bg.jpg') }});">
    </div>
    <div class="banner-one__shape-1"
        style="background-image: url({{ asset('frontend/admin/assets/images/shapes/banner-one-shape-1.png') }});"></div>
    <div class="banner-one__shape-2"
        style="background-image: url({{ asset('frontend/admin/assets/images/shapes/banner-one-shape-2.png') }});"></div>
    <div class="banner-one__shape-4 img-bounce">
        <img src="{{ asset('frontend/admin/assets/images/shapes/banner-one-shape-4.png') }}" alt="">
    </div>
    <!--<div class="banner-one__shape-5 img-bounce">-->
    <!--    <img src="{{ asset('frontend/admin/assets/images/shapes/banner-one-shape-5.png') }}" alt="">-->
    <!--</div>-->
    <div class="container">
        <div class="banner-one__content">
            <div class="banner-one__sub-title-box">
                <h5 class="banner-one__sub-title">{{ $banner->title }}</h5>
            </div>
            <h2 class="banner-one__title">{{ $banner->subtitle }}
                <span class="typed-effect" id="type-1"
                    data-strings="{{ $banner->animation_text }}"></span>
            </h2>
            <h3 class="banner-one__title-two">{{ $banner->fixed_title }} <span>{{ $banner->fixed_color_title }}</span></h3>
            <div class="banner-one__btn-and-video-box">
                <div class="banner-one__btn-box">
                    <a href="{{ url('about') }}" class="banner-one__btn thm-btn">{{ $banner->button_text }}
                        <span class="fas fa-arrow-right"></span>
                        <i></i>
                    </a>
                </div>
                <div class="banner-one__video-link">
                    <a href="https://youtu.be/aoRVC1xU1_k?si=WH9itedC3-fZIR2x" class="video-popup">
                        <div class="banner-one__video-icon-box">
                            <div class="banner-one__video-icon-inner">
                                <div class="banner-one__video-icon">
                                    <span class="fa fa-play"></span>
                                    <i class="ripple"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--<div class="banner-one__img-box">-->
            <!--    <div class="banner-one__img">-->
            <!--        <img src="https://new.jaimansha.org/public/tanzeen.png" alt="" class="" style="width:550px;">-->
            <!--    </div>-->
            <!--</div>-->
            <div class="banner-one__shape-3 ">
                <img src="{{ asset('frontend/admin/assets/images/shapes/banner-one-shape-3.png') }}" alt="">
            </div>
        </div>
    </div>
</section>
<!-- Banner One End -->
