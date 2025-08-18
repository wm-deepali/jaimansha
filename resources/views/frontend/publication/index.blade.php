@extends('frontend.layouts.master')

@section('title', '')

@section('content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url(frontend/admin/assets/images/backgrounds/page-header-bg.jpg);">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Publication</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Publication</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->



    <!--Services One Start -->
    <section class="publication-list py-5">
        <div class="container">
            <div class="row">
                @foreach ($publications as $pub)
                    <div class="col-12 mb-4">
                        <div class="card publication-card flex-row shadow-sm border-0">

                            {{-- Writer Photo --}}
                            <div class="card-img-left" style="width: 400px; background-color: #f7f7f7;">

                                <img src="{{ asset('public/uploads/authors/' . $pub->author->image) }}"
                                    alt="{{ $pub->author->name }}" class="img-fluid h-100 object-fit-cover">
                            </div>

                            {{-- Article Content --}}
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h4 class="card-title mb-2">{{ $pub->title }}</h4>
                                    <p class="card-text text-muted small mb-2">
                                        By <strong>{{ $pub->author->name }}</strong> |
                                        {{ \Carbon\Carbon::parse($pub->published_date)->format('d M, Y') }}
                                    </p>
                                    <p class="card-text">{!! $pub->short_description !!}</p>
                                </div>

                                {{-- View More --}}
                                <div>
                                    @if($pub->author->pdf)
                                        <a href="{{ asset('public/' . $pub->author->pdf) }}" target="_blank"
                                            class="btn btn-primary btn-sm">
                                            View More <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">No PDF</span>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="text-center mt-4">
                {{ $publications->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>


    <!--Services One End -->



    <!--Benefits One Start-->
    @include('frontend.home.sections.normal')
    <!--Benefits One End -->



    @include('frontend.layouts.faq')


@endsection