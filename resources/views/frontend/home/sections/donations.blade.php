        <!--4. donation Case One Start -->
        <section class="case-one">
            <div class="case-one__bg-shape float-bob-y"
                style="background-image: url({{asset('frontend/admin/assets/images/shapes/case-one-bg-shape.png')}});">
            </div>
            <div class="container">
                <div class="section-title text-center sec-title-animation animation-style1">
                    <div class="section-title__tagline-box">
                        <div class="section-title__tagline-icon">
                            <i class="icon-like"></i>
                        </div>
                        <span class="section-title__tagline">Our Global Cases</span>
                    </div>
                    <h2 class="section-title__title title-animation">Spread joy with a Donation</h2>
                </div>
                <div class="case-one__main-tab-box case-one__tabs-box">
                <ul class="case-one-tab-buttons case-one-tab-btns list-unstyled">
    <li data-tab="#allcategory" class="p-tab-btn active-btn"><span>All Category</span></li>

    @foreach($categories as $category)
        <li data-tab="#category{{ $category->id }}" class="p-tab-btn">
            <span>{{ $category->name }}</span>
        </li>
    @endforeach
</ul>

                    <div class="p-tabs-content">
                        <!-- All Category Tab -->
    <div class="p-tab active-tab" id="allcategory">
        <div class="case-one__inner">
            <div class="case-one__carousel owl-theme owl-carousel">
                @foreach($cases as $case)
                    <div class="item">
                        <div class="case-one__single">
                            <div class="case-one__img-box">
                                <div class="case-one__img">
                                    <img src="{{ asset('public/uploads/donations/'.$case->image) }}" alt="">
                                </div>
                                <div class="case-one__raised-and-progress">
                                    <div class="case-one__raised-box">
                                        <div class="doller"><span>₹</span></div>
                                        <div class="content">
                                            <h3>Charity Raised</h3>
                                            <p>₹{{ $case->donation_raised }} <span>/ ₹{{ $case->donation_required }}</span></p>
                                        </div>
                                    </div>
                                    <div class="case-one__progress">
                                        <div class="bar">
                                            @php
                                                $progress = $case->target_amount > 0 ? round(($case->amount_raised / $case->target_amount) * 100) : 0;
                                            @endphp
                                            <!--<div class="bar-inner count-bar" data-percent="{{ $progress }}%">-->
                                            <!--    <div class="count-text">{{ $progress }}%</div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="case-one__content">
                                <div class="case-one__content-inner">
                                    <p class="case-one__sub-title">{{ $case->category->name ?? 'Uncategorized' }}</p>
                                    <h3 class="case-one__title">
                                        <a href="#">{{ $case->title }}</a>
                                    </h3>
                                   <p class="case-one__text">
    {{ \Illuminate\Support\Str::words(strip_tags($case->short_description), 15, '...') }}
</p>

                                </div>
                                <ul class="case-one__days-and-count list-unstyled">
                                    <li>
                                        <div class="icon"><span class="icon-calendar"></span></div>
                                        <div class="content">
                                            <h3>Days</h3>
                                            <p>{{ $case->target_days }} Days Left</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><span class="icon-team"></span></div>
                                        <div class="content">
                                            <h3>{{ $case->supports_count }}+</h3>
                                            <p>Supporters</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

     @foreach($categories as $category)
    <div class="p-tab" id="category{{ $category->id }}">
        <div class="case-one__inner">
            <div class="case-one__carousel owl-theme owl-carousel">
                @foreach($cases->where('category_id', $category->id) as $case)
                    <div class="item">
                        <div class="case-one__single">
                            <div class="case-one__img-box">
                                <div class="case-one__img">
                                    <img src="{{ asset('public/uploads/donations/'.$case->image) }}" alt="">
                                </div>
                                <div class="case-one__raised-and-progress">
                                    <div class="case-one__raised-box">
                                        <div class="doller"><span>₹</span></div>
                                        <div class="content">
                                            <h3>Charity Raised</h3>
                                            <p>₹{{ $case->donation_raised }} <span>/ ₹{{ $case->target_amount }}</span></p>
                                        </div>
                                    </div>
                                    <div class="case-one__progress">
                                        <div class="bar">
                                            @php
                                                $progress = $case->target_amount > 0 ? round(($case->amount_raised / $case->target_amount) * 100) : 0;
                                            @endphp
                                            <!--<div class="bar-inner count-bar" data-percent="{{ $progress }}%">-->
                                            <!--    <div class="count-text">{{ $progress }}%</div>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="case-one__content">
                                <div class="case-one__content-inner">
                                    <p class="case-one__sub-title">{{ $category->name }}</p>
                                    <h3 class="case-one__title"><a href="#">{{ $case->title }}</a></h3>
                                    <p class="case-one__text">{!! $case->short_description !!}</p>
                                </div>
                                <ul class="case-one__days-and-count list-unstyled">
                                    <li>
                                        <div class="icon"><span class="icon-calendar"></span></div>
                                        <div class="content">
                                            <h3>Days</h3>
                                            <p>{{ $case->days_left }} 0 Days Left</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><span class="icon-team"></span></div>
                                        <div class="content">
                                            <h3>{{ $case->supports_count }}+</h3>
                                            <p>Supporters</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach


                    </div>
                </div>
            </div>

        </section>
        <!--Case One End -->
