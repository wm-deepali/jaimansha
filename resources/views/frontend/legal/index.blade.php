@extends('frontend.layouts.master')

@section('title', 'Legal ||')


@section('content')
      <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('frontend/admin/assets/images/backgrounds/page-header-bg.jpg')}});">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <h2>Legal</h2>
                    <div class="thm-breadcrumb__box">
                        <ul class="thm-breadcrumb list-unstyled">
                            <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                            <li><span class="icon-right-arrow-1"></span></li>
                            <li>Legal</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--Page Header End-->

       @include('frontend.layouts.legal')

       @include('frontend.layouts.helping')

        @include('frontend.layouts.faq')

@endsection