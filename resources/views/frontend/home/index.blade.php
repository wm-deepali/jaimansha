@extends('frontend.layouts.master')

@section('title', 'Home Page')


<link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/gallery.css')}}" />
<style>
    .marquee {
        width: 100%;
        overflow: hidden;
        background: #f0f0f0;
        padding: 10px 20px;
        position: relative;
        white-space: nowrap;
    }

    .marquee-content {
        display: inline-flex;
        animation: marquee 100s linear infinite;
    }

    .marquee-content span {
        padding-right: 50px;
        /* gap between duplicate */
        font-size: 18px;
        color: #333;
    }

    /* Marquee animation */
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* Links */
    .marquee a {
        color: blue;
        text-decoration: underline;
    }

    /* Hover stop */
    .marquee:hover .marquee-content {
        animation-play-state: paused;
    }

    .gallery-three {
        padding: 120px 0 0px !important;
    }
</style>


@section('content')

    <!-- Modal -->
    <div class="modal fade" id="autoModal" tabindex="-1" aria-labelledby="autoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="width:50%;">
            <div class="modal-content" style="background:#fff;">
                <div class="modal-header">
                    <h5 class="modal-title" id="autoModalLabel">Welcome</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Bootstrap Slider -->
                    <div id="modalCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                             @if($popup && $popup->active && $popup->images->count())
                                @foreach($popup->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset("public/$image->image_path") }}" class="d-block w-100 rounded"
                                            alt="Image {{ $key + 1 }}">
                                    </div>
                                @endforeach
                            @else
                                <!-- fallback static images, optional -->
                                <div class="carousel-item active">
                                    <img src="{{ asset('frontend/admin/assets/images/backgrounds/mm.jpg') }}"
                                        class="d-block w-100 rounded" alt="Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('frontend/admin/assets/images/backgrounds/mn.png') }}"
                                        class="d-block w-100 rounded" alt="Image 2">
                                </div>
                            @endif
                            
                        </div>
                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#modalCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Auto open script -->


    {{-- Banner --}}
    @include('frontend.home.sections.banner')
    <div class="marquee">
        <div class="marquee-content">
            <span>
                @foreach($marqueeMessages as $msg)
                    @if($msg->link)
                        <a href="{{ $msg->link }}" target="_blank">{!! $msg->message !!}</a>
                    @else
                        {!! $msg->message !!}
                    @endif
                @endforeach
            </span>
            <!-- <span>
                Dearest friends I m extremely Emotional today as the best gift given to me on this special day by NDT tv top
                10 in the world who featured my journey I m running out of words to thank everyone for this all yr Blessings
                and love :
                <a href="http://ntdin.tv/en/article/english/channelizing-conflict-love-care-teachers-soulful-journey-changing-young-minds"
                    target="_blank">
                    http://ntdin.tv/en/article/english/channelizing-conflict-love-care-teachers-soulful-journey-changing-young-minds
                </a>
                &nbsp; &nbsp;
                ➤ Boston give a nice title at the start paper presented in International Academic Conference 2017, Harvard
                University on " Multiple Intelligence 54"
                &nbsp; &nbsp; ➤ 200+ Parents orientation Programme done & 100+ Teachers training done within one month of
                its existence.
                &nbsp; &nbsp; ➤ Mansha Educational Society organized workshop for children of MA Ideal School, Hyderabad
                with ISRO great Scientist Mr. Uzair, who ignite thoughts of children to achieve the impossible (Check out
                photographs in Gallery Page)
            </span> -->

            <!-- Duplicate for seamless effect -->
            <!-- <span>
                Dearest friends I m extremely Emotional today as the best gift given to me on this special day by NDT tv top
                10 in the world who featured my journey I m running out of words to thank everyone for this all yr Blessings
                and love :
                <a href="http://ntdin.tv/en/article/english/channelizing-conflict-love-care-teachers-soulful-journey-changing-young-minds"
                    target="_blank">
                    http://ntdin.tv/en/article/english/channelizing-conflict-love-care-teachers-soulful-journey-changing-young-minds
                </a>
                &nbsp; &nbsp; ➤ Boston give a nice title at the start paper presented in International Academic Conference
                2017, Harvard University on " Multiple Intelligence 54"
                &nbsp; &nbsp; ➤ 200+ Parents orientation Programme done & 100+ Teachers training done within one month of
                its existence.
                &nbsp; &nbsp; ➤ Mansha Educational Society organized workshop for children of MA Ideal School, Hyderabad
                with ISRO great Scientist Mr. Uzair, who ignite thoughts of children to achieve the impossible (Check out
                photographs in Gallery Page)
            </span> -->
        </div>
    </div>

    {{-- Introduction --}}
    @include('frontend.home.sections.introduction')

    <!--Gallery One Start -->
    <section class="gallery-one gallery-three">
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <div class="section-title__tagline-icon">
                        <i class="icon-like"></i>
                    </div>
                    <span class="section-title__tagline">Our Gallery</span>
                </div>
                <h2 class="section-title__title title-animation">Our Gallery</h2>
            </div>
            <div class="gallery-one__carousel owl-theme owl-carousel">
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h1.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h1.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h2.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h2.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h3.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h3.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h4.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h4.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h5.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h5.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h6.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h6.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h7.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h7.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h8.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h8.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h9.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h9.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h10.jpeg')}}" alt=" "
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h10.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="gallery-one__single">
                        <div class="gallery-one__img">
                            <img src="{{asset('frontend/admin/assets/images/gallery/h11.jpeg')}}" alt=""
                                style="height:230px;">
                            <div class="gallery-one__arrow">
                                <a href="{{asset('frontend/admin/assets/images/gallery/h11.jpeg')}}" class="img-popup"><span
                                        class="icon-arrow-right"></span></a>
                            </div>
                            <div class="gallery-one__shape-1">
                                <img src="{{asset('frontend/admin/assets/images/shapes/gallery-one-shape-1.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Gallery One End -->
    {{-- Charity --}}
    @include('frontend.home.sections.charity')

    {{-- Donations --}}
    @include('frontend.home.sections.donations')

    @include('frontend.home.sections.normal')

    {{-- Events --}}
    @include('frontend.home.sections.events')

    @include('frontend.home.sections.charitytour')

    {{-- Team --}}
    @include('frontend.home.sections.team')

    {{-- Blogs --}}
    @include('frontend.home.sections.blogs')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById('autoModal'));
            myModal.show();
        });
    </script>

@endsection