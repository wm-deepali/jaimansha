     <!--Faq One Start -->
        <section class="faq-one faq-two">
            <div class="container">
                <div class="section-title text-center sec-title-animation animation-style1">
                    <div class="section-title__tagline-box">
                        <div class="section-title__tagline-icon">
                            <i class="icon-like"></i>
                        </div>
                        <span class="section-title__tagline">Recently Ask Question</span>
                    </div>
                    <h2 class="section-title__title title-animation">People are frequently asking <br>
                        question from us</h2>
                </div>
                <div class="row">
                    <div class="col-xl-5 col-lg-5 wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="faq-one__left">
                            <div class="faq-one__left-content">
                                <div class="faq-one__left-content-img-box">
                                    <div class="faq-one__left-content-img">
                                        <img src="{{asset('frontend/admin/assets/images/resources/faq-one-left-content-img.jpg')}}" alt="">
                                    </div>
                                    <div class="faq-one__main-info">
                                        <p>Have any question</p>
                                        <h5> <span>Mail :</span> <a href="mailto:fortazeen@gmail.com">fortazeen@gmail.com</a></h5>
                                    </div>
                                </div>
                                <div class="faq-one__left-content-box">
                                    <div class="faq-one__left-content-shape-1 float-bob-x">
                                        <img src="{{asset('frontend/admin/assets/images/shapes/faq-one-left-content-shape-1.png')}}" alt="">
                                    </div>
                                    <h3 class="faq-one__left-content-title">Get the Answer now</h3>
                                    <p class="faq-one__left-content-text">Join us in our mission uplift lives foster
                                        hope
                                        in our community. Whether you choose to volunteer,
                                        donate,or spread the word</p>
                                </div>
                            </div>
                        </div>
                    </div>
               <div class="col-xl-7 col-lg-7">
    <div class="faq-one__right">
    <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion-1" style="max-height: 500px; overflow-y: auto;">
        @foreach($faq as $index => $item)
        <div class="accrodion {{ $index == 1 ? 'active' : '' }}">
            <div class="accrodion-title">
                <h4>{{ $item->question }}</h4>
            </div>
            <div class="accrodion-content">
                <div class="faq-one__accrodion-content-bg"
                    style="background-image: url({{ asset('frontend/admin/assets/images/backgrounds/faq-one-accordion-content-bg.jpg') }});">
                </div>
                <div class="inner">
                    <p>{{ $item->answer }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</div>

                </div>
            </div>
        </section>
        <!--Faq One End -->
