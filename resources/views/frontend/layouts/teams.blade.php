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
                    <h2 class="section-title__title title-animation">Most Passionate Team</h2>
                </div>
 <div class="row">
    @foreach($team as $te)
   @if($te->team_type === 'our_team' && $te->status === 'active')
        <div class="col-xl-3 col-lg-3 wow fadeIn{{ $loop->iteration == 1 ? 'Left' : ($loop->iteration == 2 ? 'Up' : 'Right') }}" data-wow-delay="{{ $loop->iteration * 100 }}ms">
            <div class="team-one__single">
                <div class="team-one__single-shape-3">
                    <img src="{{asset('frontend/admin/assets/images/shapes/team-one-single-shape-3.png')}}" alt="">
                </div>
                <div class="team-one__single-shape-2">
                    <img src="{{asset('frontend/admin/assets/images/shapes/team-one-single-shape-2.png')}}" alt="">
                </div>
                
                <div class="team-one__img-box">
                      <div class="team-one__img" style="width: 315px; height: 300px; overflow: hidden; border-radius: 10px;">
                                    <img src="{{ asset('public/uploads/team/' . $te->image) }}" alt="{{ $te->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                </div>
                <div class="team-one__title-box">
                       <h3 class="team-one__title"><a href="#">{{ $te->name }}</a></h3>
                    <p class="team-one__sub-title text-center" style="height:170px;">{{ $te->designation ?? 'Volunteer' }}</p>
                 
                </div>
                <div class="team-one__social">
                    @if($te->facebook)
                        <a href="{{ $te->facebook }}"><span class="icon-facebook-1"></span></a>
                    @endif
                    @if($te->twitter)
                        <a href="{{ $te->twitter }}"><span class="icon-twitter-sign"></span></a>
                    @endif
                    @if($te->youtube)
                        <a href="{{ $te->youtube }}"><span class="icon-youtube-1"></span></a>
                    @endif
                    @if($te->dribbble)
                        <a href="{{ $te->dribbble }}"><span class="icon-dribble"></span></a>
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
