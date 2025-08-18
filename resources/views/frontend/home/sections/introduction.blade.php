<style>
    .stepper-form {
        /*max-width: 700px;*/
        margin: auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        /*box-shadow: 0px 5px 15px rgba(0,0,0,0.1);*/
    }
    .step-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        position: relative;
    }
    .step-header .step {
        width: 50%;
        text-align: center;
        font-weight: 600;
        color: #999;
        position: relative;
    }
    .step-header .step.active {
        color: #000;
    }
    .step-header::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        height: 3px;
        width: 100%;
        background: #eee;
        z-index: 1;
    }
    .step-header .step::after {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        height: 3px;
        width: 100%;
        background: #28a745;
        z-index: 2;
        transform: scaleX(0);
        transform-origin: left;
        transition: 0.3s ease;
    }
    .step-header .step.active::after {
        transform: scaleX(1);
    }
    .amount-buttons .btn {
        margin: 5px;
        border-radius: 50px;
    }
    .back-btn {
        background: transparent;
        border: none;
        color: #007bff;
        font-size: 16px;
        cursor: pointer;
        margin-bottom: 15px;
    }
    
</style>
    <!--About One Start -->
       <section class="about-one">
           <div class="container">
               <div class="row">
                   <div class="col-xl-6">
                       <div class="about-one__left">
                           <div class="section-title text-left sec-title-animation animation-style2">
                               <!--<div class="section-title__tagline-box">-->
                               <!--    <div class="section-title__tagline-icon">-->
                               <!--        <i class="icon-like"></i>-->
                               <!--    </div>-->
                               <!--    <span class="section-title__tagline">Introduction</span>-->
                               <!--</div>-->
                               <h2 class="section-title__title title-animation">{!!$latestIntroduction->heading!!}</h2>
                           </div>
                           <p class="about-one__text">{!!$latestIntroduction->detail_content!!} </p>

                           <ul class="list-item row clearfix list-unstyled">
                               <li class="col-xl-6 col-lg-6 col-md-6">
                                   <div class="icon">
                                       <i class="icon-handshake"></i>
                                   </div>
                                   <div class="title count-box">
                                       <h4 class="count-text" data-stop="10" data-speed="1500">00</h4>
                                       <h3>Programs</h3>
                                   </div>
                               </li>
                               <li class="col-xl-6 col-lg-6 col-md-6">
                                   <div class="icon">
                                       <i class="icon-growth"></i>
                                   </div>
                                   <div class="title count-box">
                                       <h4 class="count-text" data-stop="20" data-speed="1500">00</h4>
                                       <h3>
                                           Writers
                                       </h3>
                                   </div>
                               </li>
                           </ul>
                           <ul class="about-one__mission-and-vision list-unstyled" style="display:grid;">
                               <li>
                                   <div class="about-one__icon-and-title">
                                       <div class="about-one__icon">
                                           <span class="icon-doctor"></span>
                                       </div>
                                       <h3>Our Mission:</h3>
                                   </div>
                                   @php
    $headingText = strip_tags(optional($latestIntroduction->visionAndMission)->heading); // remove HTML
    $words = explode(' ', $headingText);
    $trimmedText = implode(' ', array_slice($words, 0, 30));
@endphp

<p class="about-one__mission-and-vision-text">
    {{ $trimmedText }}@if(count($words) > 30)... <a href="{{ route('frontend.aboutus') }}">Read More</a>@endif
</p>

                               </li>
                               <li>
                                   <div class="about-one__icon-and-title">
                                       <div class="about-one__icon">
                                           <span class="icon-team"></span>
                                       </div>
                                       <h3>Our Vision</h3>
                                   </div>
                                  @php
    $descText = strip_tags(optional($latestIntroduction->visionAndMission)->description);
    $descWords = explode(' ', $descText);
    $descPreview = implode(' ', array_slice($descWords, 0, 30));
@endphp

<p class="about-one__mission-and-vision-text">
    {{ $descPreview }}@if(count($descWords) > 30)... <a href="{{ route('frontend.aboutus') }}">Read More</a>@endif
</p>

                               </li>
                           </ul>
                           <div class="about-one__btn-box">
                               <a href="{{ route('frontend.aboutus') }}" class="about-one__btn thm-btn">Read More<span
                                       class="icon-arrow-right"></span><i></i></a>
                           </div>
                       </div>
                   </div>
                  <div class="col-xl-6">
                <div class="about-one__right">
                    <div class="donation-form-one">
                        <div class="inner-title">
                            <h3>Donate for a Cause</h3>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
<div class="step-header">
        <div class="step step-1 active"> Donation Details</div>
        <div class="step step-2">Bank Details</div>
    </div>
                       <div class="stepper-form">
    <!--<h3 class="text-center mb-4">Donate for a Cause</h3>-->

    <!-- Step Header -->
    <form id="donation-form-one" name="donation_form_one" class="default-form2"
    action="{{ route('frontend.home.introduction.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Step 1 -->
    <div class="form-step form-step-1">
        <div class="mb-3">
            <label>Select Donation For</label>
            <select name="donation_category_id" class="form-control" required>
                <option value="">-- Select Cause --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="Full Name" required></div>
        <div class="mb-3"><input type="email" name="email" class="form-control" placeholder="Email Id" required></div>
        <div class="mb-3"><input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" required></div>
        <div class="mb-3 d-flex align-items-center gap-2">
            <input type="text" name="whatsapp_number" class="form-control" placeholder="WhatsApp Number">
            <div class="form-check">
                <input type="checkbox" id="sameAsMobile" name="same_as_mobile" class="form-check-input" value="1">
                <label for="sameAsMobile" class="form-check-label">Same as Mobile</label>
            </div>
        </div>
        <div class="mb-3"><textarea name="full_address" class="form-control" placeholder="Full Address" rows="2"></textarea></div>
       <div class="row">
    <div class="col-md-6 mb-3">
        <input type="text" name="country" class="form-control" placeholder="Country">
    </div>
    <div class="col-md-6 mb-3">
        <input type="text" name="state" class="form-control" placeholder="State">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <input type="text" name="city" class="form-control" placeholder="City">
    </div>
    <div class="col-md-6 mb-3">
        <input type="text" name="pin_code" class="form-control" placeholder="Pin Code">
    </div>
</div>


        <label>Select Amount</label>
        <div class="amount-buttons mb-3">
            <button type="button" class="btn btn-outline-primary" data-amount="1000">₹1000</button>
            <button type="button" class="btn btn-outline-primary" data-amount="5000">₹5000</button>
            <button type="button" class="btn btn-outline-primary" data-amount="10000">₹10000</button>
        </div>
        <input type="hidden" name="amount" id="selectedAmount">
        <div class="mb-3"><input type="text" name="custom_amount" class="form-control" placeholder="Enter Amount of your Choice"></div>

        <div class="mb-3">
            <label>Upload Profile Picture (Optional)</label>
            <input type="file" name="profile_picture" class="form-control">
        </div>

        <!--<div class="mb-3">-->
        <!--    <label>Captcha</label>-->
        <!--    <div style="background:#eee;padding:10px;text-align:center;">[CAPTCHA HERE]</div>-->
        <!--</div>-->
        
          <div class="mb-3">
                                        <label>Captcha</label>
                                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"
                                            data-callback="onCaptchaSuccess"></div>
                                    </div>
                                    

        <!--<button type="button" class="btn btn-success w-100 next-btn">Next</button>-->
         <button type="button" class="btn btn-success w-100 next-btn" >Next</button>
    </div>

    <!-- Step 2 -->
    <div class="form-step form-step-2 d-none">
        <button type="button" class="back-btn">&larr; Back</button>
        <h5>Bank Details</h5>
        <p><strong>Account Name:</strong> {{ $donationSetting->account_name ?? 'Example Trust' }}</p>
        <p><strong>Account Number:</strong> {{ $donationSetting->account_number ?? '2222222222' }}</p>
        <p><strong>IFSC:</strong> {{ $donationSetting->ifsc_code ?? 'aaaaaaaaa' }}</p>
        <p><strong>Bank Name:</strong> {{ $donationSetting->bank_name ?? 'abcd' }}</p>
        <hr>
        <button type="submit" class="btn btn-primary w-100">Donate Now</button>
    </div>

</form>

<script>

document.querySelectorAll('.amount-buttons button').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('selectedAmount').value = this.dataset.amount;
    });
});

document.getElementById('sameAsMobile').addEventListener('change', function() {
    if (this.checked) {
        document.querySelector('[name="whatsapp_number"]').value =
            document.querySelector('[name="mobile_number"]').value;
    }
});
</script>


<!--    <form id="donateForm" enctype="multipart/form-data">-->
        
        <!-- Step 1 -->
<!--        <div class="form-step form-step-1">-->
<!--            <div class="mb-3">-->
<!--                <label>Select Donation For</label>-->
<!--                <select name="donation_for" class="form-control" required>-->
<!--                    <option value="">-- Select Cause --</option>-->
<!--                    <option value="Education">Education</option>-->
<!--                    <option value="Healthcare">Healthcare</option>-->
<!--                    <option value="Animal Welfare">Animal Welfare</option>-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="mb-3"><input type="text" name="full_name" class="form-control" placeholder="Full Name" required></div>-->
<!--            <div class="mb-3"><input type="email" name="email" class="form-control" placeholder="Email Id" required></div>-->
<!--            <div class="mb-3"><input type="text" name="mobile" class="form-control" placeholder="Mobile Number" required></div>-->
<!--            <div class="mb-3 d-flex align-items-center gap-2">-->
<!--                <input type="text" name="whatsapp" class="form-control" placeholder="WhatsApp Number">-->
<!--                <div class="form-check">-->
<!--                    <input type="checkbox" id="sameAsMobile" class="form-check-input">-->
<!--                    <label for="sameAsMobile" class="form-check-label">Same as Mobile</label>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="mb-3"><textarea name="address" class="form-control" placeholder="Full Address" rows="2"></textarea></div>-->
<!--            <div class="mb-3"><input type="text" name="country" class="form-control" placeholder="Country"></div>-->
<!--            <div class="mb-3"><input type="text" name="state" class="form-control" placeholder="State"></div>-->
<!--            <div class="mb-3"><input type="text" name="city" class="form-control" placeholder="City"></div>-->
<!--            <div class="mb-3"><input type="text" name="pincode" class="form-control" placeholder="Pin Code"></div>-->

<!--            <label>Select Amount</label>-->
<!--            <div class="amount-buttons mb-3">-->
<!--                <button type="button" class="btn btn-outline-primary" data-amount="1000">₹1000</button>-->
<!--                <button type="button" class="btn btn-outline-primary" data-amount="5000">₹5000</button>-->
<!--                <button type="button" class="btn btn-outline-primary" data-amount="10000">₹10000</button>-->
<!--            </div>-->
<!--            <div class="mb-3"><input type="text" name="custom_amount" class="form-control" placeholder="Enter Amount of your Choice"></div>-->

<!--            <div class="mb-3">-->
<!--                <label>Upload Profile Picture (Optional)</label>-->
<!--                <input type="file" name="profile_pic" class="form-control">-->
<!--            </div>-->

<!--            <div class="mb-3">-->
<!--                <label>Captcha</label>-->
<!--                <div style="background:#eee;padding:10px;text-align:center;">[CAPTCHA HERE]</div>-->
<!--            </div>-->

<!--            <button type="button" class="btn btn-success w-100 next-btn">Next</button>-->
<!--        </div>-->

        <!-- Step 2 -->
<!--<div class="form-step form-step-2 d-none">-->
<!--    <button type="button" class="back-btn">&larr; Back</button>-->
<!--    <h5>Bank Details</h5>-->
<!--    <p><strong>Account Name:</strong> {{ $donationSetting->account_name ?? 'Example Trust' }}</p>-->
<!--    <p><strong>Account Number:</strong> {{ $donationSetting->account_number ?? '2222222222' }}</p>-->
<!--    <p><strong>IFSC:</strong> {{ $donationSetting->ifsc_code ?? 'aaaaaaaaa' }}</p>-->
<!--    <p><strong>Bank Name:</strong> {{ $donationSetting->bank_name ?? 'abcd' }}</p>-->
<!--    <hr>-->
<!--    <button type="submit" class="btn btn-primary w-100">Donate Now</button>-->
<!--</div>-->

<!--    </form>-->
</div>


                    </div>
                </div>
            </div>
               </div>
           </div>
       </section>
       <!--About One End -->
       <script src="https://www.google.com/recaptcha/api.js" async defer></script>
       
       
       <script>
   const nextBtn = document.querySelector(".next-btn");
const backBtn = document.querySelector(".back-btn");
const step1 = document.querySelector(".form-step-1");
const step2 = document.querySelector(".form-step-2");
const stepHead1 = document.querySelector(".step-1");
const stepHead2 = document.querySelector(".step-2");

nextBtn.addEventListener("click", () => {
    // Check if reCAPTCHA is completed
    const recaptchaResponse = grecaptcha.getResponse();  // This gets the current recaptcha response

    if (!recaptchaResponse) {
        alert("Please complete the reCAPTCHA before proceeding.");
        return; // stop here, don’t move to next step
    }

    // reCAPTCHA completed, go next
    step1.classList.add("d-none");
    step2.classList.remove("d-none");
    stepHead1.classList.remove("active");
    stepHead2.classList.add("active");
});

backBtn.addEventListener("click", () => {
    step2.classList.add("d-none");
    step1.classList.remove("d-none");
    stepHead2.classList.remove("active");
    stepHead1.classList.add("active");
});

// Same as Mobile Checkbox
document.getElementById("sameAsMobile").addEventListener("change", function(){
    const mobile = document.querySelector('input[name="mobile"]').value;
    if(this.checked){
        document.querySelector('input[name="whatsapp"]').value = mobile;
    } else {
        document.querySelector('input[name="whatsapp"]').value = '';
    }
});

// Amount Button Click
document.querySelectorAll(".amount-buttons .btn").forEach(btn => {
    btn.addEventListener("click", () => {
        document.querySelector('input[name="custom_amount"]').value = btn.dataset.amount;
    });
});
</script>
