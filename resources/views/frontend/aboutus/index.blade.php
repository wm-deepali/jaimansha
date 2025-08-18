@extends('frontend.layouts.master')

@section('title', 'About Us ||')

<style>
  .custom-tabs .nav-link {
    background: #f8f9fa;
    color: #333;
    font-weight: 500;
    transition: 0.3s;
    text-align: start;
  }

  .custom-tabs .nav-link.active {
    background: #ff6600 !important;
    color: #fff;
  }

  .custom-tabs .nav-link i {
    font-size: 1.2rem;
  }
</style>

@section('content')

  @include('frontend.aboutus.section.pageheader')

  @include('frontend.aboutus.section.content')

  @include('frontend.layouts.advisor')

  <!--Gallery One Start -->
  <section class="gallery-one gallery-three">
    <div class="container">
    <div class="gallery-one__carousel owl-theme owl-carousel">
      <div class="item">
      <div class="gallery-one__single">
        <div class="gallery-one__img">
        <img src="{{asset('frontend/admin/assets/images/gallery/gallery-1-1.jpg')}}" alt="">
        <div class="gallery-one__arrow">
          <a href="{{asset('frontend/admin/assets/images/gallery/gallery-1-1.jpg')}}" class="img-popup"><span
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
        <img src="{{asset('frontend/admin/assets/images/gallery/gallery-1-2.jpg')}}" alt="">
        <div class="gallery-one__arrow">
          <a href="{{asset('frontend/admin/assets/images/gallery/gallery-1-2.jpg')}}" class="img-popup"><span
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
        <img src="{{asset('frontend/admin/assets/images/gallery/gallery-1-3.jpg')}}" alt="">
        <div class="gallery-one__arrow">
          <a href="{{asset('frontend/admin/assets/images/gallery/gallery-1-3.jpg')}}" class="img-popup"><span
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
        <img src="{{asset('frontend/admin/assets/images/gallery/gallery-1-4.jpg')}}" alt="">
        <div class="gallery-one__arrow">
          <a href="{{asset('frontend/admin/assets/images/gallery/gallery-1-4.jpg')}}" class="img-popup"><span
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

@endsection