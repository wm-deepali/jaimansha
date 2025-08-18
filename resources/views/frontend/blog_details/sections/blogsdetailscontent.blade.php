<!--Blog Details Start-->
<!--<section class="blog-details">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-xl-8 col-lg-7">-->
<!--                <div class="blog-details__left">-->
<!--                    <div class="blog-details__img-box">-->
<!--<div class="blog-details__img">-->
<!--    @if($blogs->banner_image)-->
<!--        <img src="{{ asset('public/' . $blogs->banner_image) }}" alt="Blog Banner Image">-->
<!--    @else-->
<!--        <img src="{{ asset('frontend/admin/assets/images/default-image.jpg') }}" alt="Default Banner">-->
<!--    @endif-->
<!--</div>                </div>-->
<!--                        <div class="blog-details__date">-->
<!--                            <p>08<br><span>june</span></p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blog-details__content">-->
<!--                        <div class="blog-details__tag-and-client-box">-->
<!--                            <div class="blog-details__tag">-->
<!--                                <p><span class="icon-folder"></span>{{$blogs->category->category_name}}</p>-->
<!--                            </div>-->
<!--                            <div class="blog-details__client-box">-->
<!--                                <div class="blog-details__client-img">-->
<!--                                    <img src="{{asset('frontend/admin/assets/images/blog/blog-details-client-img.jpg')}}" alt="">-->
<!--                                </div>-->
<!--                                <p class="blog-details__client-name">{{$blogs->category->written_by}}</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <h3 class="blog-details__title-1">{{$blogs->title}}-->
<!--                        </h3>-->
<!--                        <div class="blog-details__shape-1">-->
<!--                            <img src="{{asset('frontend/admin/assets/images/shapes/blog-details-shape-1.png')}}" alt="">-->
<!--                        </div>-->
<!--                        <p class="blog-details__text-1">{!!$blogs->detail_content!!}<br></p>-->
<!--                        <div class="blog-details__quote-box">-->
<!--                            <div class="blog-details__quote-icon">-->
<!--                                <span class="icon-quote"></span>-->
<!--                            </div>-->
<!--                            <p class="blog-details__quote-text">{!! $blogs->short_description !!}</p>-->
<!--                        </div>-->
<!--                        <ul class="blog-details__points list-unstyled">-->
                            <!--<li>-->
                            <!--    <div class="blog-details__points-shape"></div>-->
                            <!--    <p>{!! $blogs->meta_description !!}</p>-->
                            <!--</li>-->
<!--                        </ul>-->
<!--                        <p class="blog-details__text-2">{!!$blogs->category->meta_description !!}</p>-->
                
<!--                        <div class="blog-details__client-box-2">-->
<!--                            <div class="blog-details__client-img-2">-->
<!--                                    @if(!$blogs->thumbnail_image)-->
<!--        <img src="{{ asset('public/' . $blogs->thumbnail_image) }}" alt="Blog Banner">-->
<!--    @else-->
<!--        <img src="{{ asset('frontend/admin/assets/images/shapes/blog-one-shape-1.png') }}" alt="Default Banner">-->
<!--    @endif-->
                                <!--<img src="{{asset('frontend/admin/assets/images/blog/blog-details-client-img-2.jpg')}}" alt="">-->
<!--                            </div>-->
<!--                            <div class="blog-details__client-content-2">-->
<!--                                <h3>{{$blogs->category->written_by}}</h3>-->
<!--                                <p>{{$blogs->title}}</p>-->
                            
<!--                            </div>-->
<!--                        </div>-->
                        
                        
                            
                    <!-- Right Column (Other Blogs) -->
<!--            <div class="col-xl-4 col-lg-5">-->
<!--                <div class="sidebar">-->
<!--                    <h4 class="sidebar__title">Other Blogs</h4>-->
<!--                    <ul class="list-unstyled">-->
<!--                        @foreach($otherBlogs as $oblog)-->
<!--                            <li class="sidebar__blog-item" style="margin-bottom: 15px; display: flex; align-items: center;">-->
<!--                                <div class="sidebar__blog-img" style="width: 80px; height: 60px; overflow: hidden; border-radius: 5px; margin-right: 10px;">-->
<!--                                    <a href="{{ route('frontend.blog_details.index', $oblog->slug) }}">-->
<!--                                        <img src="{{ asset('public/' . $oblog->thumbnail_image) }}" alt="{{ $oblog->title }}" style="width: 100%; height: auto;">-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                                <div class="sidebar__blog-content">-->
<!--                                    <a href="{{ route('frontend.blog_details.index', $oblog->slug) }}" style="font-size: 14px; font-weight: 600; color: #333;">-->
<!--                                        {{ $oblog->title }}-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        @endforeach-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->

<!--        </div>-->
    
<!--    </div>-->
<!--</section>-->
<!--Blog Details End-->
<!-- Blog Details Start -->
<section class="blog-details">
    <div class="container">
        <div class="row">

            <!-- Left Column -->
            <div class="col-xl-8 col-lg-7">
                <div class="blog-details__left">
                    <div class="blog-details__img-box">
                        <div class="blog-details__img">
                            @if($blogs->banner_image)
                                <img src="{{ asset('public/' . $blogs->banner_image) }}" alt="Blog Banner Image">
                            @else
                                <img src="{{ asset('frontend/admin/assets/images/default-image.jpg') }}" alt="Default Banner">
                            @endif
                        </div>
                    </div>
                    <!--<div class="blog-details__date">-->
                    <!--    <p>08<br><span>june</span></p>-->
                    <!--</div>-->
                </div>

                <div class="blog-details__content">
                    <div class="blog-details__tag-and-client-box">
                        <div class="blog-details__tag">
                            <p><span class="icon-folder"></span>{{ $blogs->category->category_name }}</p>
                        </div>
                        <div class="blog-details__client-box">
                            <div class="blog-details__client-img">
                                <img src="{{ asset('frontend/admin/assets/images/blog/blog-details-client-img.jpg') }}" alt="">
                            </div>
                            <p class="blog-details__client-name">{{ $blogs->category->written_by }}</p>
                        </div>
                    </div>
                    <h3 class="blog-details__title-1">{{ $blogs->title }}</h3>
                    <div class="blog-details__shape-1">
                        <img src="{{ asset('frontend/admin/assets/images/shapes/blog-details-shape-1.png') }}" alt="">
                    </div>
                    <p class="blog-details__text-1">{!! $blogs->detail_content !!}<br></p>
                    <div class="blog-details__quote-box">
                        <div class="blog-details__quote-icon">
                            <span class="icon-quote"></span>
                        </div>
                        <p class="blog-details__quote-text">{!! $blogs->short_description !!}</p>
                    </div>
                    <ul class="blog-details__points list-unstyled"></ul>
                    <p class="blog-details__text-2">{!! $blogs->category->meta_description !!}</p>

                    <div class="blog-details__client-box-2">
                        <div class="blog-details__client-img-2">
                            @if(!$blogs->thumbnail_image)
                                <img src="{{ asset('public/' . $blogs->thumbnail_image) }}" alt="Blog Banner">
                            @else
                                <img src="{{ asset('frontend/admin/assets/images/shapes/blog-one-shape-1.png') }}" alt="Default Banner">
                            @endif
                        </div>
                        <div class="blog-details__client-content-2">
                            <h3>{{ $blogs->category->written_by }}</h3>
                            <p>{{ $blogs->title }}</p>
                        </div>
                    </div>
                </div>
            </div> <!-- End Left Column -->

            <!-- Right Column (Other Blogs) -->
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">
                    <h4 class="sidebar__title">Recent Blogs</h4><br>
                    <ul class="list-unstyled">
                        @foreach($otherBlogs as $oblog)
                            <li class="sidebar__blog-item" style="margin-bottom: 15px; display: flex; align-items: center;">
                                <div class="sidebar__blog-img" style="width: 80px; height: 60px; overflow: hidden; border-radius: 5px; margin-right: 10px;">
                                    <a href="{{ route('frontend.blog_details.index', $oblog->slug) }}">
                                        <img src="{{ asset('public/' . $oblog->thumbnail_image) }}" alt="{{ $oblog->title }}" style="width: 100%; height: auto;">
                                    </a>
                                </div>
                                <div class="sidebar__blog-content">
                                    <a href="{{ route('frontend.blog_details.index', $oblog->slug) }}" style="font-size: 14px; font-weight: 600; color: #333;">
                                        {{ $oblog->title }}
                                    </a>
                                </div>
                            </li>
                            <hr>
                        @endforeach
                    </ul>
                </div>
            </div> <!-- End Right Column -->

        </div>
    </div>
</section>
<!-- Blog Details End -->
