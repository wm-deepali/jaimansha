<!--Event One Start -->
<section class="event-one">
    <div class="event-one__shape-1 float-bob-y">
        <img src="{{ asset('frontend/admin/assets/images/shapes/event-one-shape-1.png') }}" alt="">
    </div>
    <div class="event-one__shape-2 float-bob-x">
        <img src="{{ asset('frontend/admin/assets/images/shapes/event-one-shape-2.png') }}" alt="">
    </div>
    <div class="container">
        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box">
                <div class="section-title__tagline-icon">
                    <i class="icon-like"></i>
                </div>
                <span class="section-title__tagline">Our Recent Events</span>
            </div>
            <h2 class="section-title__title title-animation">Join Our Events</h2>
        </div>
      <ul class="event-one__event-list list-unstyled">
    @foreach($event as $e)
        <li class="wow fadeInUp" data-wow-delay="100ms">
            <div class="event-one__single">
                <div class="event-one__content-and-date-box">
                    <!-- <div class="event-one__img-and-content d-flex {{ $loop->iteration % 2 == 0 ? 'flex-row-reverse' : '' }}"> -->
                        <div class="event-one__img-and-content d-flex {{ $loop->iteration % 2 == 0 ? 'flex-row-reverse' : '' }} gap-4">

                        <div class="event-one__img-box">
                            <div class="event-one__img">
                               @if(!empty($e->thumb_image) && file_exists(public_path('uploads/events/' . $e->thumb_image)))
       <img src="{{ asset('frontend/admin/assets/images/resources/event-1-1.jpg') }}" alt="Default Image">
@else
 <img src="{{ asset('public/' . $e->thumb_image) }}" alt="{{ $e->event_name }}" style="width:250px;">
 
@endif

                            </div>
                            <div class="event-one__tag">
                                <span>{{ $e->event_name ?? 'Education' }}</span>
                            </div>
                        </div>

                        <div class="event-one__content">
                            <h3 class="event-one__title">
                                <a href="#">{{ $e->event_name }}</a>
                            </h3>
                            <ul class="event-one__meta list-unstyled">
                                <li class="col-6" >
                                  
<!--<p>{!! $e->description ?? 'Our vision is to build a just, educated, and culturally vibrant society where every individual has the opportunity to learn, grow, and live with dignity.' !!}</p>-->
                                </li>
                               
                            </ul>
                        <div class="event-one__btn-box">
    <a href="{{ route('frontend.events_details.index', $e->slug) }}" class="event-one__btn thm-btn">
        Event Details
        <span class="icon-arrow-right"></span><i></i>
    </a>
</div>
                        </div>
                    </div>

                    <div class="event-one__date-box">
                        <div class="event-one__date-inner">
                            <div class="event-one__date-shape-1">
                                <img src="{{ asset('frontend/admin/assets/images/shapes/event-one-date-shape-1.png') }}" alt="">
                            </div>
                            <p class="event-one__date">{{ \Carbon\Carbon::parse($e->event_date)->format('d M Y') }}</p>
                            <ul class="event-one__meta list-unstyled">
                                <li>
                                    <div class="icon"><span class="icon-time"></span></div>
                                    <p>{{ $e->event_time }}</p>
                                </li>
                                <li>
                                    <div class="icon"><span class="icon-map"></span></div>
                                    <p>{{ $e->event_venue }}</p>
                                </li>
                            </ul>
                        </div>
                        <!--<h4 class="event-one__speaker-title">Our Speakers</h4>-->
                        <!--<ul class="event-one__speaker-list list-unstyled">-->
                        <!--    <li><div class="event-one__speaker-img"><img src="{{ asset('frontend/admin/assets/images/resources/event-one-speaker-img-1-1.jpg') }}" alt=""></div></li>-->
                        <!--    <li><div class="event-one__speaker-img"><img src="{{ asset('frontend/admin/assets/images/resources/event-one-speaker-img-1-2.jpg') }}" alt=""></div></li>-->
                        <!--    <li><div class="event-one__speaker-img"><img src="{{ asset('frontend/admin/assets/images/resources/event-one-speaker-img-1-3.jpg') }}" alt=""></div></li>-->
                        <!--    <li><div class="event-one__speaker-img"><img src="{{ asset('frontend/admin/assets/images/resources/event-one-speaker-img-1-4.jpg') }}" alt=""></div></li>-->
                        <!--</ul>-->
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>

    </div>
</section>
<!--Event One End -->
