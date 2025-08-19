      
      <style>
          .event-card {
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}
.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.event-info h6 {
    font-size: 15px;
    color: #444;
}
.event-info p {
    font-size: 14px;
}

.icon-box {
    width: 40px;
    height: 40px;
    background: #f0f8ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #007bff;
    font-size: 18px;
}

      </style>
      
      
      
        <section class="event-details">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="event-details__left">
                            <div class="event-details__img">
                               <!--<img src="{{ asset('admin/assets/images/resources/event-details-img-1.jpg') }}" alt="">-->
                                <img src="{{ asset('public/' . $event->banner_image) }}" alt="{{ $event->event_name }}">

                            </div>
                            <div class="event-details__content">
                                <h3 class="event-details__title-1">{{$event->event_name}}</h3>
                                <div class="event-details__shape-1">
                                    <img src=" admin/assets/images/shapes/event-details-shape-1.png'" alt="">
                                </div>
                                <p class="event-details__text-1">{!! $event->description !!}</p>
                                <!--<p class="event-details__text-2">{!! $event->short_detail !!} </p>-->
                                <!--<ul class="event-details__points list-unstyled">-->
                                <!--    <li>-->
                                <!--        <div class="event-details__points-shape"></div>-->
                                <!--        <p class="event-details__points-text">{!! $event->events_point_para !!}</p>-->
                                <!--    </li>-->
                                <!--</ul>-->
                                <!--<p class="event-details__text-3">{!!$event->event_last_heading !!}</p>-->

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="event-details__right">
                            <div class="event-details__recent-events-box mb-4">
                        <h4 class="text-center mb-3 border-bottom">Recent Events</h4>
                        <ul class="event-details__recent-events-list list-unstyled">
                            @forelse($recentEvents as $recent)
                                <li class="d-flex mb-2">
                                    <div
                                        style="width:60px; height:50px; overflow:hidden; border-radius:4px; margin-right:10px;">
                                        <img src="{{ asset('public/' . $recent->banner_image) }}"
                                            alt="{{ $recent->event_name }}" style="width:100%; height:auto;">
                                    </div>
                                    <div>
                                        <a href="{{ route('frontend.events_details.index', $recent->slug) }}" class="event-one__btn thm-btn">
                                            style="font-weight:500; color:#333;">{{ $recent->event_name }}</a>
                                        <br>
                                        <small class="text-secondary">
                                            {{ \Carbon\Carbon::parse($recent->event_date)->format('j F Y') }}
                                        </small>
                                    </div>
                                </li>
                            @empty
                                <li>No other events found.</li>
                            @endforelse
                        </ul>
                    </div>
                            <div class="event-details__services-box">
                                <h4 class="text-center mb-3 border-bottom">{{$event->event_name}}</h4>
                                <ul class="event-details__services-list list-unstyled">
                                    <li>
                                        <h5>Time & Date<span>:</span></h5>
                                       <p>
                                            {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }},
    {{ \Carbon\Carbon::parse($event->event_date)->format('j F Y') }}
   
</p>

                                    </li>
                                   
                                    <li>
                                        <h5>Phone<span>:</span></h5>
                                        <p><a href="tel:000854222">{{$event->mobile_number}}</a></p>
                                    </li>
                                    <li>
                                        <h5>Venue<span>:</span></h5>
                                        <p>{{$event->event_venue}}</p>
                                    </li>
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!--Event Details End-->
<script>

    window.addEventListener("scroll", function() {
  const serviceBox = document.querySelector(".event-details__services-box");
  const offset = 60;

  if (window.scrollY > offset) {
    serviceBox.style.position = "fixed";
    serviceBox.style.top = offset + "px";
    serviceBox.style.right = "50px"; // adjust as needed
    serviceBox.style.width = "380px"; // fix width for box
    // Optional: give z-index if needed
    // serviceBox.style.zIndex = "99";
  } else {
    serviceBox.style.position = "static";
    serviceBox.style.width = "auto";
  }
});


</script>