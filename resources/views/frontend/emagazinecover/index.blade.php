@extends('frontend.layouts.master')

@section('title', 'Events ||')


@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{asset('frontend/admin/assets/images/apj.png')}});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>E-Magzine</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>E-Magzine</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Event One Start -->
    <section class="event-one event-one--event py-5" style="background-color: #f5f6f8;">
        <div class="container">
            <div class="row align-items-center bg-white shadow rounded overflow-hidden"
                style="max-width: 900px; margin: auto;">

                <!-- Left Side Carousel -->
                <div class="col-md-6 p-0">
                    <div id="scientistCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner text-center p-4"
                            style="height: 100%; background: linear-gradient(to right, #1abc9c, #3498db); color: white;">

                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <img src="https://jaimansha.org/images/isro.jpg" class="rounded-circle mb-3"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                                <h6 class="fw-bold text-uppercase">SYED SHADAB (SCIENTIST)</h6>
                                <p class="mb-0"><strong>National Remote Sensing Centre</strong><br>
                                    <span style="color: #ffeaa7;">ISRO, Hyderabad</span>
                                </p>
                                <p class="mt-2" style="font-size: 13px;">In realizing the goals of the National Policy of
                                    ICT in Schools Education... commendable. I wish all the success in future.</p>
                            </div>

                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <img src="https://jaimansha.org/images/george.png" class="rounded-circle mb-3"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                                <h6 class="fw-bold text-uppercase">MR. GEORGE SALAZAR</h6>
                                <p class="mb-0"><strong>NASA, Johnson Space Center</strong></p>
                                <p class="mt-2" style="font-size: 13px;">I congratulate your society’s pursuit of quality
                                    education programs in India for both rural and urban areas... epitome of that quote.</p>
                            </div>

                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <img src="https://jaimansha.org/images/mujeeb.jpg" class="rounded-circle mb-3"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                                <h6 class="fw-bold text-uppercase">MR. UZAIR MUJEEB (SCIENTIST)</h6>
                                <p class="mb-0"><strong>ISRO</strong><br>
                                    <span style="color: #ffeaa7;">Hyderabad</span>
                                </p>
                                <p class="mt-2" style="font-size: 13px;">I congratulate your society Mansha for doing
                                    remarkable work in the field of Education and helping children... rise with Excellence.
                                </p>
                            </div>

                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#scientistCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#scientistCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <!-- Right Side Content -->
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center text-white">
                    <img src="https://jaimansha.org/images/mansha02.jpg" alt="Book Pen" class="img-fluid mb-3"
                        style="max-height: 180px;">
                    <h5 class="fw-bold">INTERNATIONAL VISION INDIA READER</h5>
                    <a href="{{ route('frontend.emagazine') }}" class="btn btn-primary">Click to E-Magazine</a>
                </div>

            </div>
        </div>
    </section>
    <!--Event One End -->
@endsection