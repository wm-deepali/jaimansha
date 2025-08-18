@extends('frontend.layouts.news')

@section('content')



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
                        {{-- PDF Type News --}}
                        <tr>
                            <td>14 Aug 2025, 10:30 AM</td>
                            <td>
                                <a href="{{ asset('public/news_pdfs/news-sample1.pdf') }}" target="_blank" class="fw-bold text-primary">
                                    Annual Report 2025 Released
                                </a><br>
                                <a href="{{ asset('public/news_pdfs/news-sample1.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                    View PDF
                                </a>
                            </td>
                        </tr>

                        {{-- Description Type News --}}
                        <tr>
                            <td>12 Aug 2025, 04:15 PM</td>
                            <td>
                                <strong>New Library Section Opened</strong>
                                <p class="mb-1 short-desc" id="short-desc-1">
                                    The city library has inaugurated a new section dedicated to historical archives...
                                </p>
                                <div class="full-desc d-none" id="full-desc-1">
                                    The city library has inaugurated a new section dedicated to historical archives, featuring manuscripts, maps, and books dating back to the 17th century. The section is open for public visits every weekday from 10 AM to 6 PM.
                                </div>
                                <a href="javascript:void(0)" class="text-primary" onclick="toggleDescription(1)">Read More</a>
                            </td>
                        </tr>

                        {{-- Only Title Type News --}}
                        <tr>
                            <td>10 Aug 2025, 09:00 AM</td>
                            <td><strong>Community Sports Day Announced</strong></td>
                        </tr>

                        {{-- Another PDF News --}}
                        <tr>
                            <td>08 Aug 2025, 03:20 PM</td>
                            <td>
                                <a href="{{ asset('public/news_pdfs/news-sample2.pdf') }}" target="_blank" class="fw-bold text-primary">
                                    Budget Summary for FY 2024-25
                                </a><br>
                                <a href="{{ asset('public/news_pdfs/news-sample2.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                    View PDF
                                </a>
                            </td>
                        </tr>

                        {{-- Another Description News --}}
                        <tr>
                            <td>06 Aug 2025, 11:45 AM</td>
                            <td>
                                <strong>Summer Art Workshop for Kids</strong>
                                <p class="mb-1 short-desc" id="short-desc-2">
                                    Registrations are open for the annual summer art workshop for children aged 8-14...
                                </p>
                                <div class="full-desc d-none" id="full-desc-2">
                                    Registrations are open for the annual summer art workshop for children aged 8-14. The workshop will cover painting, clay modeling, and digital art. Seats are limited, so early registration is advised.
                                </div>
                                <a href="javascript:void(0)" class="text-primary" onclick="toggleDescription(2)">Read More</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Right: Sticky Image --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <img src="{{ asset('frontend/admin/assets/images/news/news-sidebar.jpg') }}" 
                         alt="News Sidebar" 
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
