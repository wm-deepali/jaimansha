<section class="services-one">
    <div class="services-one__bg" style="background-image: url({{ asset('frontend/admin/assets/images/backgrounds/donatebg.jpg') }});">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="services-one__left">
                    <div class="section-title text-left sec-title-animation animation-style2">
                        <div class="section-title__tagline-box">
                            <div class="section-title__tagline-icon">
                                <i class="icon-like"></i>
                            </div>
                            <span class="section-title__tagline">Our Programs</span>
                        </div>
                        <h2 class="section-title__title title-animation">We believe in the welfare of the Society</h2>
                    </div>
                    <div class="services-one__shape-1 float-bob-x">
                        <img src="{{ asset('frontend/admin/assets/images/shapes/services-one-shape-1.png') }}" alt="">
                    </div>
                    <div class="services-one__shape-2 float-bob-y">
                        <img src="{{ asset('frontend/admin/assets/images/shapes/services-one-shape-2.png') }}" alt="">
                    </div>
                </div>
            </div>
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

                              @php
    $descText = strip_tags($donate->description);
    $descWords = explode(' ', $descText);
    $descPreview = implode(' ', array_slice($descWords, 0, 13));
@endphp

<p class="services-one__text" style="text-align:left;">
    {{ $descPreview }}@if(count($descWords) > 13)... @endif
</p>



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
<a href="{{ route('frontend.charity_details.index', $donate->slug) }}">Read More<span class="icon-arrow-right"></span></a>

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
