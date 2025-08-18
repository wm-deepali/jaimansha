    <!--Feature-three Start -->
        <section class="feature-three feature-four">
            <div class="container">
                <div class="section-title text-center sec-title-animation animation-style1">
                    <div class="section-title__tagline-box">
                        <div class="section-title__tagline-icon">
                            <i class="icon-like"></i>
                        </div>
                        <span class="section-title__tagline">Legal Documents</span>
                    </div>
                    <h2 class="section-title__title title-animation">
                        Legal Documents </h2>
                </div>
                <ul class="row list-unstyled">
@foreach($legal as $item)
    <li class="col-xl-4 col-lg-6 wow fadeInLeft" data-wow-delay="100ms">
        <div class="feature-three__single">
            <div class="feature-three__content-box">
                <div class="feature-three__icon">
                    <span class="icon-humanitarian"></span>
                    <div class="feature-three__icon-shape-1">
                        <img src="{{asset('frontend/admin/assets/images/shapes/feature-three-icon-shape-1.png')}}" alt="">
                    </div>
                </div>
                <div class="feature-three__icon-content">
                    <h4 class="feature-three__title">
                        <a href="#">{{ $item->title }}</a>
                    </h4>
                    <p class="feature-three__text">{!! $item->short_info !!}</p>
                </div>
            </div>
            <div class="feature-three__img">
               <img src="{{ asset('public/uploads/legal/' . $item->image) }}" alt="User Image">
                <div class="feature-three__count"></div>
            </div>
        </div>
    </li>
@endforeach


                </ul>
            </div>
        </section>
        <!--Feature-three End -->
