@extends('frontend.layouts.master')

@section('title', 'Blog ||')

<style>
    .sidebar-sticky img {
        position: -webkit-sticky;
        /* Safari support */
        position: sticky;
        top: 100px;
        z-index: 100;
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
                <h2>News</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>News</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <section class="news-page py-5">
        <div class="container">
            <div class="row">
                {{-- Left: Static News List --}}
                <div class="col-lg-8">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 180px;">Date & Time</th>
                                <th>News</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($news as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, h:i A') }}</td>
                                    <td>
                                        {{-- PDF TYPE --}}
                                        @if($item->news_type === 'pdf' && $item->pdf_file)
                                            <a href="{{ asset('uploads/news_pdfs/' . $item->pdf_file) }}" target="_blank"
                                                class="fw-bold text-primary">
                                                {{ $item->news_title }}
                                            </a><br>
                                            <a href="{{ asset('uploads/news_pdfs/' . $item->pdf_file) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary mt-1">
                                                View PDF
                                            </a>

                                            {{-- DETAIL TYPE --}}
                                        @elseif($item->news_type === 'detail' && $item->detail_content)
                                            <strong>{{ $item->news_title }}</strong>
                                            <p class="mb-1 short-desc" id="short-desc-{{ $item->id }}">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($item->detail_content), 100) }}
                                            </p>
                                            <div class="full-desc d-none" id="full-desc-{{ $item->id }}">
                                                {!! $item->detail_content !!}
                                            </div>
                                            <a href="javascript:void(0)" class="text-primary"
                                                onclick="toggleDescription({{ $item->id }})">Read More</a>

                                            {{-- LINK TYPE --}}
                                        @elseif($item->news_type === 'link' && $item->link_url)
                                            <a href="{{ $item->link_url }}" target="_blank" class="fw-bold text-primary">
                                                {{ $item->news_title }}
                                            </a>
                                        @else
                                            <strong>{{ $item->news_title }}</strong>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No news available</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- Right: Sticky Image --}}
                <div class="col-lg-4">
                    <div class="sidebar-sticky mt-2">
                        <img src="{{ asset('frontend/admin/assets/images/backgrounds/donatebg.jpg') }}" alt="News Sidebar"
                            class="img-fluid rounded shadow">
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Toggle Description Script --}}
    <script>
        function toggleDescription(id) {
            document.getElementById('short-desc-' + id).classList.toggle('d-none');
            document.getElementById('full-desc-' + id).classList.toggle('d-none');
        }
    </script>
@endsection