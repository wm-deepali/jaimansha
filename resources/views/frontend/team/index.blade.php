@extends('frontend.layouts.master')

@section('title', 'Teams')


@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{asset('frontend/admin/assets/images/backgrounds/page-header-bg.jpg')}});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Teams</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Teams</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->
    <section class="team-details">
        <div class="team-details__bg-shape-1"
            style="background-image: url(asset('frontend/admin/assets/images/shapes/team-details-shape-1.png')}});"></div>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.teams')

            </div>
        </div>
    </section>

@endsection