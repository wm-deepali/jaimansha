@extends('frontend.layouts.master')

@section('title', 'Events ||')

<style>
    .section-title {
        font-size: 30px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 30px;
    }

    .sch-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
    }

    .sch-title::after {
        content: "";
        display: block;
        width: 50px;
        height: 3px;
        background-color: orange;
        margin-top: 8px;
    }

    .sch-text {
        font-size: 16px;
        color: #333;
        line-height: 1.7;
    }

    .sch-list {
        list-style: none;
        padding-left: 0;
    }

    .sch-list li {
        margin-bottom: 10px;
        font-size: 16px;
        color: #333;
    }

    .sch-list li i {
        color: orange;
        margin-right: 8px;
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
                <h2>Membership Form</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Membership Form</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Event One Start -->
    <section class="event-one event-one--event">
        <div class="event-one__shape-1 float-bob-y">
            <img src="assets/images/shapes/event-one-shape-1.png" alt="">
        </div>
        <div class="event-one__shape-2 float-bob-x">
            <img src="assets/images/shapes/event-one-shape-2.png" alt="">
        </div>


        <div class="container my-5 p-5">

            <!-- Membership Info Row -->
            <div class="row">
                <div class="col-md-6">
                    <h3 class="sch-title">Applying For Membership Of Mansha</h3>
                    {!! $content->apply !!}
                </div>
                <div class="col-md-6">
                    <h3 class="sch-title">Benefit Of Membership</h3>
                    {!! $content->benefits!!}
                </div>
            </div>

            <!-- Terms and Fee Row -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <h3 class="sch-title">Membership Fee Structure</h3>
                    {!! $content->fee_structure!!}
                </div>
                <div class="col-md-6">
                    <h3 class="sch-title">General Terms & Conditions</h3>
                    {!! $content->terms!!}
                </div>
            </div>

            <!-- Scholastic & Co-Scholastic Row -->


            <!-- Registration Button -->
            <div class="text-center mt-5">
                <a href="{{ route('frontend.membership_registration')}}" class="btn btn-warning px-5 py-2"
                    style="font-weight: bold; border-radius: 30px;">Membership Registration</a>
            </div>

        </div>



    </section>
    <!--Event One End -->

@endsection