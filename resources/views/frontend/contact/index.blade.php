@extends('frontend.layouts.master')

@section('title', 'Contact ||')

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
            style="background-image: url({{asset('frontend/admin/assets/images/backgrounds/page-header-bg.jpg')}})">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Contact Us</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Contact Page Start-->
    <section class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="contact-page__left">
                        <div class="section-title text-left sec-title-animation animation-style2">
                            <div class="section-title__tagline-box">
                                <div class="section-title__tagline-icon">
                                    <i class="icon-like"></i>
                                </div>
                                <span class="section-title__tagline">Conatct Us</span>
                            </div>
                            <h2 class="section-title__title title-animation">Request a Free Quote
                                <br> Get this Contact
                            </h2>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="contact-page__google-map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd"
                                        class="google-map__one" allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="contact-page__contact-box">
                                    <ul class="contact-page__contact-list list-unstyled">
                                        <li>
                                            <span>Call anytime</span>
                                            <p><a href="tel:980009630">{!! $footer->mobile !!}</a></p>
                                        </li>
                                        <li>
                                            <span>Send email</span>
                                            <p><a href="mailto:info@company.com"></a>{!! $footer->email !!}</p>
                                        </li>
                                        <li>
                                            <span>Visit Office</span>
                                            {!! $footer->address !!}
                                        </li>
                                    </ul>
                                    <div class="contact-page__contact-box-shape-1">
                                        <img src="{{asset('frontend/admin/assets/images/shapes/contact-page-contact-box-shape-1.png')}}"
                                            alt="">
                                    </div>
                                    <ul class="contact-page__social-box list-unstyled">
                                        <li><a href="#"><span class="icon-facebook"></span></a></li>
                                        <li><a href="#"><span class="icon-twitter"></span></a></li>
                                        <li><a href="#"><span class="icon-instagram-logo"></span></a></li>
                                        <li><a href="#"><span class="icon-youtube"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="contact-page__right">
                        {{-- Success message --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- Error message --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="contact-page__form" action="{{ route('frontend.contact.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <h3 class="contact-page__input-title">Name</h3>
                                    <div class="contact-page__input-box">
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="Enter your name" required>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <h3 class="contact-page__input-title">Email</h3>
                                    <div class="contact-page__input-box">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="Email address" required>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <h3 class="contact-page__input-title">Phone</h3>
                                    <div class="contact-page__input-box">
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone no"
                                            required>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <h3 class="contact-page__input-title">Subject</h3>
                                    <div class="contact-page__input-box">
                                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subject"
                                            required>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <h3 class="contact-page__input-title">Select Services</h3>
                                    <div class="contact-page__input-box">
                                        <input type="text" name="services" value="{{ old('services') }}"
                                            placeholder="Services" required>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <h3 class="contact-page__input-title">Message</h3>
                                    <div class="contact-page__input-box text-message-box">
                                        <textarea name="message" placeholder="Your Comments"
                                            required>{{ old('message') }}</textarea>
                                    </div>
                                    <div class="contact-page__btn-box">
                                        <button type="submit" class="thm-btn contact-page__btn">
                                            Send Request<span class="icon-arrow-right"></span><i></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Contact Page End-->
@endsection
