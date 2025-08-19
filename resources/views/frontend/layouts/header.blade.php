<style>
    .main-menu__logo a img{
        width: 160px; 
        background-color: #fff; 
        padding: 7px; 
        border-radius: 3px;
        border: 1px solid rgba(128, 128, 128, 0.068);
        margin-top: -14px;
        
    }
    @media (max-width: 540px) {
   .main-menu__logo a img{
        width: 80px; 
        background-color: #fff; 
        padding: 7px; 
        border-radius: 3px;
        border: 1px solid rgba(128, 128, 128, 0.068);
         margin-top: 5px;
        
    }
}
</style>       
       
       
        <header class="main-header">
            <div class="main-menu__top">
                <div class="container">
                    <div class="main-menu__top-inner">
                        <ul class="list-unstyled main-menu__contact-list">
                            <li>
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="text">
                                    <p><a href="tel:1212345678900">{{$header->helplineNumber}}</a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="text">
                                    <p><a href="tel:1212345678900">{{$header->mobileNumber}}</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="icon-mail"></i>
                                </div>
                                <div class="text">
                                    <p><a href="mailto:support@example.com">{{$header->email}}</a></p>
                                </div>
                            </li>
                        </ul>
                        <div class="main-menu__top-social-box">
                            <ul class="list-unstyled main-menu__contact-list">
                            <li>

                                <div class="text">
                                     <p><a href="{{route('career') }}">Career</a>
                                    </p>
                                </div>
                            </li>
                            <li>

                                <div class="text">
                                  <!--<a href="" style="color:#fff">Events</a>-->
                                  <a href="{{ route('frontend.events.index') }}" style="color:#fff">Events</a>

                                </div>
                            </li>
                            <li>

                                <div class="text">
                                    <p><a href="{{ route('news')}}">News</a></p>
                                </div>
                            </li>
                            <li>

                                 <div class="text">
                                    <p><a href="{{ asset('public/'.$brochures->pdf_file) }}">E-Brochure</a></p>
                                </div>
                            </li>
                            <li class="custom-dropdown">
    <div class="text">
        <p>
            <a href="javascript:void(0)">Contact Us <span class="arrow">▼</span></a>
        </p>
        <ul class="dropdown-menu">
            <li><a href="#"></a></li>
             <li><a href="{{ route('contact') }}">Contact Us</a></li>
<li><a href="{{ url('/become_volunteers') }}">Become Volunteers</a></li>

            <li><a href="{{ route('frontend.testimonial.index')}}">Share your Feedback</a></li>
 <li><a href="{{ route('frontend.complaint_suggestions.index') }}">Complaints & Suggestion</a></li>
           <li><a href="{{ route('faq') }}">FAQ</a></li>
        </ul>
    </div>
</li>

                        </ul>
                        </div>
                    </div>
                </div>
            </div>
<nav class="main-menu" style="height: 100px;">
    <div class="main-menu__wrapper">
        <div class="container">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ route('frontend.home') }}">
                            <img src="{{ asset('frontend/admin/assets/images/jaimansa-logo.png') }}" alt="" style="">
                        </a>
                    </div>
                </div>
                <div class="main-menu__main-menu-box">
                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                    <ul class="main-menu__list">
                       <li class="megamenu current">
    <a href="{{ route('frontend.home') }}">Home</a>
</li>

<li class="dropdown">
    <a href="#">About Us</a>
    <ul class="shadow-box">
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
</li>


                    <li class="">
    <a href="{{ route('frontend.sponsorship_registation') }}">Sponsorship</a>
   
</li>

<li class="">
    <a href="{{ route('frontend.scholarship') }}">Scholarship</a>
    
</li>

<li class="dropdown">
    <a href="#">Program</a>
    <ul class="shadow-box">
        <!-- @php
            use App\Models\admin\Program\ProgramModel;
            $programs = ProgramModel::where('status', 1)->get();
        @endphp -->

        @foreach($programs as $program)
            <li>
                <a href="{{ route('frontend.program.show', $program->slug) }}">
                    {!! $program->title !!}
                </a>
            </li>
        @endforeach
    </ul>
</li>




<li class="">
    <a href="{{ route('frontend.membership_detail') }}">Membership</a>
    <!--<ul class="shadow-box">-->
    <!--    <li><a href="{{ route('frontend.membership_detail') }}">Membership Detail</a></li>-->
    <!--    <li><a href="{{ route('frontend.membership_registration')}}">Membership Registration</a></li>-->
    <!--</ul>-->
</li>

<li class="dropdown">
    <a href="#">Donations</a>
    <ul class="shadow-box">
        <li><a href="{{ route('frontend.our_donors') }}">Our Donors</a></li>
        <li><a href="{{ route('frontend.donate_us') }}">Donate Us</a></li>
    </ul>
</li>

<li><a href="{{ route('frontend.publication') }}">Publications</a></li>
<li><a href="{{ route('frontend.emagazinecover') }}">E-Magazine</a></li>

                </div>
            </div>
        </div>
    </div>
</nav>

        </header>
