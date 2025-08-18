         <!-- Event content section One Start -->
        <section class="event-one event-one--event">
            <div class="event-one__shape-1 float-bob-y">
                <img src="admin/assets/images/shapes/event-one-shape-1.png" alt="">
            </div>
            <div class="event-one__shape-2 float-bob-x">
                <img src="admin/assets/images/shapes/event-one-shape-2.png" alt="">
            </div>
            <div class="container">
              <ul class="event-one__event-list list-unstyled">
             @foreach($events as $e)
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
 <img src="{{ asset('public/' . $e->thumb_image) }}" alt="{{ $e->event_name }}">
 
@endif
                            </div>
                            <div class="event-one__tag">
                                <span>{{ $e->event_name ?? 'Education' }}</span>
                            </div>
                        </div>

                        <div class="event-one__content">
                            <h3 class="event-one__title">
                                <a href="#">{{ $e->event_name }}</a>
                                <p style="font-size:14px; font-weight:400;color:gray;">{!! $e->short_detail !!}</p>
                            </h3>
                            
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
                                <img src="{{ asset('admin/assets/images/shapes/event-one-date-shape-1.png') }}" alt="">
                            </div>
                            <p class="event-one__date">{{ \Carbon\Carbon::parse($e->event_date)->format('d M Y') }}</p>
                        </div>
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
                </div>
            </div>
        </li>
    @endforeach
        </ul>
                <div class="blog-list__pagination text-center">

                </div>
            </div>
        </section>
