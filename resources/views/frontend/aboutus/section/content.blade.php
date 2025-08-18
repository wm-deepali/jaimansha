 <!--About One Start -->
        <section class="about-one pdb120">
            <div class="container">
                <div class="section-title text-center sec-title-animation animation-style1">
                    <div class="section-title__tagline-box">
                        <div class="section-title__tagline-icon">
                            <i class="icon-like"></i>
                        </div>
                        <span class="section-title__tagline">Know more about Us</span>
                    </div>
                    <h2 class="section-title__title title-animation">{!! $aboutUs->heading_1 !!}</h2>
                </div>
                <div class="row">
                    <!-- Left Tabs Navigation -->
                    <div class="col-md-4">
                        <div class="nav flex-column nav-pills custom-tabs shadow-sm p-3 rounded" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active mb-2" id="about-tab" data-bs-toggle="pill" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="true">
                                <i class="icon-like me-2"></i> About Us
                            </button>
                            <button class="nav-link mb-2" id="mission-tab" data-bs-toggle="pill" data-bs-target="#mission" type="button" role="tab" aria-controls="mission" aria-selected="false">
                                <i class="icon-doctor me-2"></i> Our Mission
                            </button>
                            <button class="nav-link" id="vision-tab" data-bs-toggle="pill" data-bs-target="#vision" type="button" role="tab" aria-controls="vision" aria-selected="false">
                                <i class="icon-team me-2"></i> Our Vision
                            </button>
                        </div>
                    </div>

                    <!-- Right Tab Content -->
                    <div class="col-md-8">
                        <div class="tab-content p-4 bg-white rounded shadow-sm" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                <h2 class="fw-bold mb-3">{!! $aboutUs->heading_2 !!}</h2>
                                <p>{!! $aboutUs->Description !!}</p>
                                
                            </div>
                            <div class="tab-pane fade" id="mission" role="tabpanel" aria-labelledby="mission-tab">
                                <h3 class="fw-bold">Our Mission</h3>
                                <p>{!!$visionAndMission->heading!!}</p>
                            </div>
                            <div class="tab-pane fade" id="vision" role="tabpanel" aria-labelledby="vision-tab">
                                <h3 class="fw-bold">Our Vision</h3>
                                <p>{!!$visionAndMission->description!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
