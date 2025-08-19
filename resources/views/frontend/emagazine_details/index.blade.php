@extends('frontend.layouts.master')

@section('title', 'Events ||')


@section('content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{asset('frontend/admin/assets/images/backgrounds/page-header-bg.jpg')}});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>E-Magazine_Details </h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>E-Magazine</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <section class="magazine-details py-5">
        <div class="container">
            <h1 class="mb-3">{{ $magazines->title }}</h1>
            <p class="text-muted">
                By {{ $magazines->author->name ?? 'Unknown Author' }}
                <!--| Category: {{ $magazines->category->name ?? 'Uncategorized' }}-->
            </p>

            <div class="mb-4">
                {!! $magazines->short_description !!}
            </div>

            <div class="services-one__img-box">
                <div class="services-one__img">
                    <img src="{{ asset('public/uploads/authors/' . $magazines->author->image) }}"
                        alt="{{ $magazines->title }}">
                </div>
                <div class="services-one__icon-inner">
                    <div class="services-one__icon">
                        <span class="icon-mortarboard"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection