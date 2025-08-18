<!--Service Details Start-->
<section class="service-details">
    <div class="container">
        <div class="row">
            <!-- Left Content -->
            <div class="col-xl-8 col-lg-7">
                <div class="service-details__left">
                    {{-- Video/Image Section --}}
                    @if(!empty($program->video_image))
                        <div class="service-details__img">
                            <img src="{{ asset('public/uploads/programs/' . $program->video_image) }}" alt="{{ $program->title }}">
                        </div>
                    @endif

                    <div class="service-details__content">
                        <h3 class="service-details__title-1">{{ $program->title }}</h3>

                        {{-- Text Sections --}}
                        @if(!empty($program->text_1))
                            <p class="service-details__text-1">{!! $program->text_1 !!}</p>
                        @endif
                        @if(!empty($program->text_2))
                            <p class="service-details__text-2">{!! $program->text_2 !!}</p>
                        @endif

            {{-- Points --}}
@php
    $pointsArray = is_array($program->points) ? $program->points : explode(',', $program->points);
@endphp

@if(!empty($pointsArray))
    <ul class="service-details__points list-unstyled">
        @foreach($pointsArray as $point)
            @if(!empty(trim($point)))
                <li>
                    <div class="icon"><span class="icon-check"></span></div>
                    <p>{{ trim($point) }}</p>
                </li>
            @endif
        @endforeach
    </ul>
@endif


                        {{-- Video --}}
                        @if(!empty($program->video_url))
                            <div class="service-details__video-img">
                                <img src="{{ asset('public/uploads/programs/' . $program->video_image) }}" alt="Video">
                                <div class="service-details__video-link">
                                    <a href="{{ $program->video_url }}" class="video-popup">
                                        <div class="service-details__video-icon-inner">
                                            <div class="service-details__video-icon">
                                                <span class="icon-play"></span>
                                                <i class="ripple"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Text 3 --}}
                        @if(!empty($program->text_3))
                            <p class="service-details__text-3">{!! $program->text_3 !!}</p>
                        @endif

                    {{-- Decode the tabs JSON --}}
@php
    $decodedTabs = json_decode($program->tabs, true);
@endphp

{{-- Check if tabs exist --}}
@if(!empty($decodedTabs) && is_array($decodedTabs))
    <div class="service-details__tab-box">
        <div class="service-details__main-tab-box tabs-box">

            {{-- Tab Buttons --}}
            <ul class="tab-buttons list-unstyled">
                @foreach($decodedTabs as $index => $tab)
                    <li data-tab="#tab{{ $index }}" class="tab-btn {{ $index == 0 ? 'active-btn' : '' }}">
                        <span>{{ $tab['title'] ?? 'Untitled Tab' }}</span>
                    </li>
                @endforeach
            </ul>

            {{-- Tab Contents --}}
            <div class="tabs-content">
                @foreach($decodedTabs as $index => $tab)
                    <div class="tab {{ $index == 0 ? 'active-tab' : '' }}" id="tab{{ $index }}">
                        <div class="service-details__inner-content-box">
                            <p class="service-details__tab-text-1">
                                {{ $tab['description'] ?? 'No description available.' }}
                            </p>
                        </div>

                        {{-- Tab Points --}}
                        @if(!empty($tab['points']) && is_array($tab['points']))
                            <ul class="service-details__tab-points list-unstyled">
                                @foreach($tab['points'] as $point)
                                    <li>
                                        <div class="service-details__tab-points-shape"></div>
                                        <p class="service-details__tab-points-text">{{ $point }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endif

                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-5">
                <!--<div class="sidebar">-->
                <!--    {{-- Search --}}-->
                <!--    <div class="sidebar__single sidebar__search">-->
                        <!--<form action="#" class="sidebar__search-form">-->
                        <!--    <input type="search" placeholder="Search here">-->
                        <!--    <button type="submit"><i class="icon-magnifying-glass"></i></button>-->
                        <!--</form>-->
                <!--    </div>-->

                    {{-- Tabs in Sidebar --}}
                    @if(!empty($decodedTabs) && is_array($decodedTabs))
                        <div class="sidebar__single sidebar__all-category-box">
                            <div class="sidebar__title-box">
                                <div class="sidebar__title-shape"></div>
                                <h3 class="sidebar__title">Tabs</h3>
                            </div>
                            <div class="sidebar__all-category">
                                <ul class="sidebar__all-category-list list-unstyled">
                                    @foreach($decodedTabs as $tab)
                                        <li><a href="#">{{ $tab['title'] ?? 'Tab' }} <span class="icon-arrow-right"></span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- Contact Form --}}
                    <!--<div class="sidebar__single sidebar__have-question">-->
                    <!--    <div class="sidebar__title-box">-->
                    <!--        <div class="sidebar__title-shape"></div>-->
                    <!--        <h3 class="sidebar__title">Have Your Question</h3>-->
                    <!--    </div>-->
                    <!--    <div class="sidebar__have-question-inner">-->
                    <!--        <form class="contact-form-validated sidebar__have-question-form" action="#" method="post">-->
                    <!--            <div class="row">-->
                    <!--                <div class="col-xl-12">-->
                    <!--                    <div class="have-question__input-box">-->
                    <!--                        <div class="have-question__input-icon">-->
                    <!--                            <span class="icon-user"></span>-->
                    <!--                        </div>-->
                    <!--                        <input type="text" name="name" placeholder="Name" required>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--                <div class="col-xl-12">-->
                    <!--                    <div class="have-question__input-box text-message-box">-->
                    <!--                        <div class="have-question__input-icon">-->
                    <!--                            <span class="icon-open-mail"></span>-->
                    <!--                        </div>-->
                    <!--                        <textarea name="message" placeholder="Your Message"></textarea>-->
                    <!--                    </div>-->
                    <!--                    <div class="have-question__btn-box">-->
                    <!--                        <button type="submit" class="thm-btn have-question__btn">-->
                    <!--                            Submit Now <span class="icon-arrow-right"></span><i></i>-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </form>-->
                    <!--        <div class="result"></div>-->
                    <!--    </div>-->
                    <!--</div>-->

                <!--    {{-- Download --}}-->
                <!--    <div class="sidebar__single sidebar__download-box">-->
                <!--        <div class="sidebar__title-box">-->
                <!--            <div class="sidebar__title-shape"></div>-->
                <!--            <h3 class="sidebar__title">Download</h3>-->
                <!--        </div>-->
                <!--        <div class="sidebar__download-list-box">-->
                <!--            <ul class="sidebar__download-list list-unstyled">-->
                <!--                <li><a href="#">Download Doc <span class="icon-direct-download"></span></a></li>-->
                <!--                <li><a href="#">Download Pdf <span class="icon-download-pdf"></span></a></li>-->
                <!--            </ul>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</section>
<!--Service Details End-->
