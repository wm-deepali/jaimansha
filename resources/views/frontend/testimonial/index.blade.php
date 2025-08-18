@extends('frontend.layouts.master')

@section('title', 'About Us ||')


<style>
    .custom-tabs .nav-link {
        background: #f8f9fa;
        color: #333;
        font-weight: 500;
        transition: 0.3s;
        text-align: start;
    }

    .custom-tabs .nav-link.active {
        background: #ff6600 !important;
        color: #fff;
    }

    .custom-tabs .nav-link i {
        font-size: 1.2rem;
    }

    .testimonial-card {
        border: 1px solid #ddd;
        padding: 1rem;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
        height: 100%;
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
                <h2>Testimonials</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Testimonials</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->



    @include('frontend.layouts.testimonial')

    @include('frontend.layouts.feedback')


    @include('frontend.layouts.gallery')

@endsection