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
        font-size: 36px;
        /* Bigger font size */
        font-weight: 800;
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
                <h2>Scholastic</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Scholastic</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!--Event One Start -->
    <section class="event-one event-one--event">
        <div class="event-one__shape-1 float-bob-y">
            <img src="assets/images/shapes/event-one-shape-1.png" alt="">
        </div>
        <div class="event-one__shape-2 float-bob-x">
            <img src="assets/images/shapes/event-one-shape-2.png" alt="">
        </div>


        <div class="container my-5 p-5">

            <div class="row">
                <!-- Scholastic Column -->
                <div class="col-md-12">
                    <!--<h3 class="sch-title">SCHOLASTIC</h3>-->
                    <p class="sch-text">
                        @foreach($scholastics as $item)
                                <!--<h1>{!! $item->title !!}</h1>-->
                            <h1 class="sch-title">{!! $item->title !!}</h1>
                            <br>
                            <h3>{!! $item->content !!}</h3>
                        @endforeach

                </div>

                <!-- Co-Scholastic Column -->
                <!--<div class="col-md-6">-->
                <!--    <h3 class="sch-title">CO-SCHOLASTIC</h3>-->
                <!--    <ul class="sch-list">-->
                <!--        @foreach ($scholastics as $scholastic)-->
                <!--            @foreach ($scholastic->coScholastics as $co)-->
                <!--                <li><i class="fa-solid fa-check-circle"></i> {{ $co->content }}</li>-->
                <!--            @endforeach-->
                <!--        @endforeach-->
                <!--    </ul>-->
                <!--</div>-->


    </section>
    <!--Event One End -->

@endsection