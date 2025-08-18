@extends('frontend.layouts.master')

@section('title', 'Donation Now')

<style>
    .qr-form-section {
        padding: 50px 0;
    }

    .qr-form__left,
    .qr-form__right {
        padding: 20px;
    }

    .qr-form__qr-box {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .qr-code img {
        border: 2px solid #ddd;
        border-radius: 5px;
    }

    .donate-amount {
        display: flex;
        gap: 10px;
    }

    .amount-btn,
    .qr-form__btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .amount-btn:hover,
    .qr-form__btn:hover {
        background-color: #0056b3;
    }

    .addAmount-value {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .qr-form__payment-list {
        margin-bottom: 20px;
    }

    .custom-radio {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .radio-dot {
        width: 20px;
        height: 20px;
        border: 2px solid #007bff;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        margin-right: 10px;
    }

    .radio-dot::after {
        content: '';
        width: 10px;
        height: 10px;
        background: #007bff;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    input[type="radio"]:checked+.radio-dot::after {
        opacity: 1;
    }

    .qr-form__input-box {
        margin-bottom: 15px;
    }

    .qr-form__input-box input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .qr-form__total-amount {
        margin: 20px 0;
        font-size: 1.2rem;
    }

    .qr-form__btn-box {
        text-align: center;
    }

    .qr-form__img-box {
        position: relative;
        margin-bottom: 20px;
    }

    .qr-form__raised-and-progress {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .qr-form__raised-box {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .doller span {
        font-size: 1.5rem;
        color: #007bff;
    }

    .qr-form__progress .bar {
        width: 100%;
        background: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }

    .bar-inner {
        height: 10px;
        background: #007bff;
        border-radius: 10px;
        position: relative;
    }

    .count-text {
        position: absolute;
        top: -25px;
        right: 0;
        font-size: 0.9rem;
    }

    .qr-form__content {
        padding: 15px;
    }

    .qr-form__client-box {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .qr-form__client-box-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .qr-form__client-img img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
    }

    .qr-form__client-box-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 5px 0;
    }

    .icon span {
        font-size: 1.2rem;
        color: #007bff;
    }

    .nice-select {
        height: 40px !important;
        line-height: 31px !important;
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
                <h2>Membership Form</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Membership Form</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Donation Now Start-->
    <section class="membership-form-section py-5">
        <div class="contact-block">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-12 text-center">
                        <h3 class="fw-bold">Membership Form</h3>
                        <p>Welcome to Mansha Educational, Cultural and Social Welfare Society</p>
                    </div>
                </div>

                <div class="row g-4">

                    @include('frontend.layouts.membershipform')
                    @include('frontend.layouts.qrcode')

                </div>
            </div>
        </div>
    </section>

@endsection