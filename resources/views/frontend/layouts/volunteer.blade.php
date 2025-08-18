        <!--Team One Start -->
        <section class="team-one">
            <div class="team-one__shape-1 img-bounce">
                <img src="{{asset('frontend/admin/assets/images/shapes/team-one-shape-1.png')}}" alt="">
            </div>
            <div class="team-one__shape-2">
                <img src="{{asset('frontend/admin/assets/images/shapes/team-one-shape-2.png')}}" alt="">
            </div>
            <div class="container">
                <div class="section-title text-center sec-title-animation animation-style1">
                    <div class="section-title__tagline-box">
                        <div class="section-title__tagline-icon">
                            <i class="icon-like"></i>
                        </div>
                        <span class="section-title__tagline">Meet Our Team</span>
                    </div>
                    <h2 class="section-title__title title-animation">Most Passionate Valunteer</h2>
                </div>
 <div class="row">
    @foreach($volunteers as $vo)
    @if($vo->team_type === 'volunteers' && $vo->status === 'active')
        <div class="col-xl-4 col-lg-4 wow fadeIn{{ $loop->iteration == 1 ? 'Left' : ($loop->iteration == 2 ? 'Up' : 'Right') }}" data-wow-delay="{{ $loop->iteration * 100 }}ms">
            <div class="team-one__single">
                <div class="team-one__single-shape-3">
                    <img src="{{asset('frontend/admin/assets/images/shapes/team-one-single-shape-3.png')}}" alt="">
                </div>
                <div class="team-one__single-shape-2">
                    <img src="{{asset('frontend/admin/assets/images/shapes/team-one-single-shape-2.png')}}" alt="">
                </div>
                <div class="team-one__title-box">
                    <p class="team-one__sub-title">{{ $vo->designation ?? 'Volunteer' }}</p>
                    <h3 class="team-one__title"><a href="#">{{ $vo->name }}</a></h3>
                </div>
                <div class="team-one__img-box">
                      <div class="team-one__img" style="width: 250px; height: 250px; overflow: hidden; border-radius: 10px;">
                                    <img src="{{ asset('public/uploads/team/' . $vo->image) }}" alt="{{ $vo->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                </div>
                <div class="team-one__social">
                    @if($vo->facebook)
                        <a href="{{ $vo->facebook }}"><span class="icon-facebook-1"></span></a>
                    @endif
                    @if($vo->twitter)
                        <a href="{{ $vo->twitter }}"><span class="icon-twitter-sign"></span></a>
                    @endif
                    @if($vo->youtube)
                        <a href="{{ $vo->youtube }}"><span class="icon-youtube-1"></span></a>
                    @endif
                    @if($vo->dribbble)
                        <a href="{{ $vo->dribbble }}"><span class="icon-dribble"></span></a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>

            </div>
        </section>
        <!--Team One End -->
