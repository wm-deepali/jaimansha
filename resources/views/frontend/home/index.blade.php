@extends('frontend.layouts.master')

@section('title', 'Home Page')


 <link rel="stylesheet" href="{{asset('frontend/admin/assets/css/module-css/gallery.css')}}" />
<style>
    .marquee {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
        background: #f0f0f0;
        padding: 10px 20px;
        position: relative;
    }
    .marquee span {
        display: inline-block;
        padding-right: 100%;
        animation: marquee 100s linear infinite;
        font-size: 18px;
        color: #333;
    }

    @keyframes marquee {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }

    /* Arrow separator styling */
    .marquee li {
        display: inline;
        list-style: none;
    }
    .marquee li a {
        color: blue;
        text-decoration: underline;
    }
    .marquee li::after {
        content: " ➤ ";
        margin: 0 15px;
        color: #ff6600;
    }
    .marquee:hover span {
  animation-play-state: paused; /* hover par stop ho jayega */
}
</style>


@section('content')

    {{-- Banner --}}
    @include('frontend.home.sections.banner')
<div class="marquee">
    <span>
        <ul>
            <li>
                Dearest friends I m extremely Emotional today as the best gift given to me on this special day by NDT tv top 10 in the world who featured my journey I m running out of words to thank everyone for this all yr Blessings and love :
                <a href="http://ntdin.tv/en/article/english/channelizing-conflict-love-care-teachers-soulful-journey-changing-young-minds" target="_blank">
                    http://ntdin.tv/en/article/english/channelizing-conflict-love-care-teachers-soulful-journey-changing-young-minds
                </a>
                ➤ Boston give a nice title at the start paper presented in International Academic Conference 2017, Harvard University on " Multiple Intelligence 54"
                ➤ 200+ Parents orientation Programme done & 100+ Teachers training done within one month of its existence.
                ➤ Mansha Educational Society organized workshop for children of MA Ideal School, Hyderabad with ISRO great Scientist Mr. Uzair, who ignite thoughts of children to achieve the impossible (Check out photographs in Gallery Page)
            </li>
        </ul>
    </span>
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h1.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h2.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h3.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h4.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h5.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h6.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h7.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h8.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h9.jpeg')}}" alt="" style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h10.jpeg')}}" alt=" " style="height:230px;">
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
                                <img src="{{asset('frontend/admin/assets/images/gallery/h11.jpeg')}}" alt="" style="height:230px;">
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

@endsection
