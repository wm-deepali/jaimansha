@extends('frontend.layouts.master')

@section('title', 'About Us ||')

<style>
    .custom-tabs .nav-link {
        background: #f8f9fa;
        color: #333;
        font-weight: 500;
        transition: 0.3s;
    }

    .custom-tabs .nav-link.active {
        background: #ff6600 !important;
        color: #fff;
    }

    .custom-tabs .nav-link i {
        font-size: 1.2rem;
    }

    .custom-tabs .nav-link {
        text-align: start !important;
    }
</style>


@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{asset('frontend/admin/assets/images/backgrounds/page-header-bg.jpg')}});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Sponsorship</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Sponsorship</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--About One Start -->
    <section class="about-one pdb120">
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <div class="section-title__tagline-icon">
                        <i class="icon-like"></i>
                    </div>
                    <span class="section-title__tagline">Our Sponsorship</span>
                </div>
                <h2 class="section-title__title title-animation">Spread joy with a Donation</h2>
            </div>
            <div class="row">
                <!-- Left Tabs Navigation -->
                <div class="col-md-4">
                    <div class="nav flex-column nav-pills custom-tabs shadow-sm p-3 rounded" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active mb-2" id="about-tab" data-bs-toggle="pill" data-bs-target="#about"
                            type="button" role="tab" aria-controls="about" aria-selected="true">
                            <i class="icon-like me-2"></i> {!! $sponshorship->title1  !!}
                        </button>
                        <button class="nav-link mb-2" id="mission-tab" data-bs-toggle="pill" data-bs-target="#mission"
                            type="button" role="tab" aria-controls="mission" aria-selected="false">
                            <i class="icon-doctor me-2"></i> {!! $sponshorship->title2  !!}
                        </button>
                        <button class="nav-link mb-2" id="vision-tab" data-bs-toggle="pill" data-bs-target="#vision"
                            type="button" role="tab" aria-controls="vision" aria-selected="false">
                            <i class="icon-team me-2"></i> {!! $sponshorship->title3  !!}
                        </button>
                        <button class="nav-link" id="sponsor-tab" data-bs-toggle="pill" data-bs-target="#sponsor"
                            type="button" role="tab" aria-controls="sponsor" aria-selected="false">
                            <i class="icon-team me-2"></i> {!! $sponshorship->title4  !!}
                        </button>
                    </div>
                </div>

                <!-- Right Tab Content -->
                <div class="col-md-8">
                    <div class="tab-content p-4 bg-white rounded shadow-sm" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                            <h1>{!! $sponshorship->title1  !!}</h1><br>
                            {!! $sponshorship->short_description1  !!}
                        </div>
                        <div class="tab-pane fade" id="mission" role="tabpanel" aria-labelledby="mission-tab">
                            <h1>{!! $sponshorship->title2  !!}</h1><br>
                            {!! $sponshorship->short_description2  !!}
                        </div>
                        <div class="tab-pane fade" id="vision" role="tabpanel" aria-labelledby="vision-tab">
                            <h1>{!! $sponshorship->title3  !!}</h1><br>
                            {!! $sponshorship->short_description3  !!}
                        </div>
                        <div class="tab-pane fade" id="sponsor" role="tabpanel" aria-labelledby="vision-tab">
                            <div class="row justify-content-center mb-4">
                                <div class="col-lg-12 text-center">
                                    <h1 class="fw-bold">Sponsor Form</h1>
                                    <p>Become a sponsor for Event, Scholarship, or Educational Initiatives</p>
                                </div>
                            </div>

                            @include('frontend.layouts.sponsorform')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.counter')
    @include('frontend.home.sections.donations')
    @include('frontend.home.sections.team')
    @include('frontend.layouts.testimonial')
@endsection