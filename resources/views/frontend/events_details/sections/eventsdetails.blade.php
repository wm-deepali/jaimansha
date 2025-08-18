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
                                <div class="event-details__btn-box">
                                    <a href="#" class="event-details__btn thm-btn">Donation Now<span
                                            class=""></span><i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="event-details__right">
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
                                    <!--<li>-->
                                    <!--    <h5>Date<span>:</span></h5>-->
                                    <!--    <p>{{$event->event_date}}</p>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                    <!--    <h5>Category<span>:</span></h5>-->
                                    <!--    <p></p>-->
                                    <!--</li>-->
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
                            <!--<div class="event-details__google-map">-->
                            <!--    <iframe-->
                            <!--        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd"-->
                            <!--        class="event-details__google-map-one" allowfullscreen></iframe>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Event Details End-->
<script>
    window.addEventListener("scroll", function() {
  const sidebar = document.querySelector(".event-details__right");
  const offset = 60; // header ke neeche ka gap
  if (window.scrollY > offset) {
    sidebar.style.position = "fixed";
    sidebar.style.top = offset + "px";
    sidebar.style.right = "50px"; // apne design ke hisaab se adjust karo
    sidebar.style.width = "380px"; // width fix karna jaruri hai
  } else {
    sidebar.style.position = "static";
    sidebar.style.width = "auto";
  }
});

</script>