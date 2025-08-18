   <footer class="site-footer">
       <div class="site-footer__shape-bg"
           style="background-image: url({{asset('frontend/admin/assets/images/shapes/site-footer-shape-bg.png')}});"></div>
       <div class="site-footer__shape-1 float-bob-y">
           <img src="{{asset('admin/assets/images/shapes/site-footer-shape-1.png')}}" alt="">
       </div>
       <div class="site-footer__top">
           <div class="container">
               <div class="site-footer__top-inner">
                   <div class="row">
                       <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                           <h4 class="footer-widget__title">About Us</h4>
                               <ul class="footer-widget__links-list list-unstyled">
                                   <li><a href="{{ route('frontend.aboutus') }}">About Us</a></li>
        <li><a href="{{ route('frontend.managementcommittee') }}">Management Committee</a></li>
        <li><a href="{{ route('frontend.awards') }}">Awards & Certifications</a></li>
        <li><a href="{{ route('frontend.team') }}">Our Team</a></li>
        <li><a href="{{ route('frontend.advisor') }}">Our Advisor</a></li>
        <li><a href="{{ route('frontend.Volunteers') }}">Our Volunteers</a></li>
        <li><a href="{{ route('frontend.scholastics') }}">Scholastics</a></li>
        <li><a href="{{ route('frontend.co_scholastic') }}">Co-Scholastic</a></li>
        <li><a href="{{ route('frontend.legal') }}">Legal</a></li>
        <li><a href="{{ route('frontend.report') }}">Annual Reports</a></li>
                               </ul>
                       </div>
                       <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                           <div class="footer-widget__links">
                               <h4 class="footer-widget__title">Our Programmes</h4>
                               <ul class="footer-widget__links-list list-unstyled">
                                  @foreach($programs as $program)
            <li>
                <a href="{{ route('frontend.program.show', $program->slug) }}">
                    {!! $program->title !!}
                </a>
            </li>
        @endforeach
                               </ul>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                           <div class="footer-widget__donars">
                               <h4 class="footer-widget__title">Know More</h4>
                               <ul class="footer-widget__links-list list-unstyled">
<li><a href="{{ route('frontend.sponsorship_registation') }}">Sponsorship</a></li>

                                   <li><a href="{{ route('frontend.scholarship') }}">Scholarship</a></li>
                                   <li><a href="{{ route('frontend.membership_detail') }}">Membership</a></li>
                                   <li><a href="{{ route('frontend.publication') }}">Publications</a></li>
                                   <li><a href="{{ route('frontend.emagazinecover') }}">E-Magazine</a></li>
                                   <li><a href="{{ route('frontend.events.index') }}">Events</a></li>
                                   <!--<li><a href="kids-education.html">Advocacy</a></li>-->
                               </ul>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                           <div class="footer-widget__payment">
                               <h4 class="footer-widget__title">Important Link</h4>
                               <ul class="footer-widget__links-list list-unstyled">
                                    <li><a href="#">Latest News</a></li>

                                   <li><a href="{{ route('contact') }}">Contact us</a></li>
                                   <li><a href="{{ route('frontend.donate_us') }}">Donate Us</a></li>
                                   <li><a href="money-raised.html">Share your Feedback</a></li>
                                   <li><a href="{{ route('frontend.complaint_suggestions.index') }}">Complaint & Suggestions</a></li>
                                   <li><a href="{{route('frontend.home') }}">Career</a></li>
                                   <li><a href="{{ url('/become_volunteers') }}">Become a Volunteer</a></li>
                                   <li><a href="{{ route('frontend.blog.index')}}">Blogs</a></li>
                                   <li><a href="{{ route('faq') }}">FAQ</a></li>
                                   <li><a href="{{ route('faq') }}">Terms & Conditions</a></li>
                                   <li><a href="{{ route('faq') }}">Privacy Policy</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
