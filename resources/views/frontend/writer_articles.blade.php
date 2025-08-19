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
                <h2>Article by Writer</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Article by Writer</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Event One Start -->
    <section class="event-one event-one--event">
        <div class="event-one__shape-1 float-bob-y">
            <img src="{{asset('frontend/admin/assets/images/shapes/event-one-shape-1.png')}}" alt="">
        </div>
        <div class="event-one__shape-2 float-bob-x">
            <img src="{{asset('frontend/admin/assets/images/shapes/event-one-shape-2.png')}}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="left-magzine-card">
                        @foreach($articles as $magazine)
                            @if($magazine->author && $magazine->author->author_type === 'magazine')
                                <div class="left-magzine-data-link">
                                    <p class="magazine-date">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        {{ \Carbon\Carbon::parse($magazine->created_at)->format('d/m/Y') }}
                                    </p>

                                    <p class="magzine-heading">
                                        {{ $magazine->title }}
                                    </p>

                                    <p class="magazine-discription">
                                        {!! Str::limit($magazine->short_description, 150) !!}
                                    </p>

                                    <p class="readmore">
                                        <a href="{{ route('frontend.emagazine_details.show', $magazine->id) }}">
                                            Read More <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </p>
                                </div>
                                <hr>
                            @endif
                        @endforeach

                    </div>

                </div>

             
            </div>
        </div>

    </section>
    <!--Event One End -->
@endsection