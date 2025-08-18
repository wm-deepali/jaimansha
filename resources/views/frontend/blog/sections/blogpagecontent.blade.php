<!--Blog Page Start-->
<section class="blog-three blog-page">
    <div class="container">
        <ul class="row list-unstyled">
            @foreach ($blogs as $blog)
                <!--Blog Three Single Start-->
                <li class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
                    <div class="blog-three__single">
                        <div class="blog-three__tag">
                            <p><span class="icon-folder"></span>{{ $blog->category->category_name ?? 'Uncategorized' }}</p>
                        </div>
                        <h3 class="blog-three__title">
                            <a href="{{ route('frontend.blog_details.index', $blog->slug) }}">{{ $blog->title ?? 'No Title' }}</a>
                        </h3>
                        <div class="blog-three__single-shape">
                            <img src="{{asset('frontend/admin/assets/images/shapes/blog-three-single-shape-1.png')}}" alt="">
                        </div>
                        <div class="blog-three__img-box">
                            <div class="blog-three__img">
@if($blog->thumbnail_image)
    <img src="{{ asset('public/' . $blog->thumbnail_image) }}" alt="Blog Banner">
@else
    <img src="{{ asset('frontend/admin/assets/images/default-image.jpg') }}" alt="Default">
@endif


                                <div class="blog-three__icon">
                                    <a href="{{ route('frontend.blog_details.index', $blog->slug) }}"><span class="icon-plus"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-three__client-info">
                            <div class="blog-three__client-img">
                                <img src="{{asset('frontend/admin/assets/images/blog/blog-three-client-img-1.jpg')}}" alt="">
                            </div>
                            <div class="blog-three__client-content">
                                <h5>{{ $blog->category->written_by ?? 'Admin' }}</h5>
                                <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M Y') }} . 3 mins to read</p>
                            </div>
                        </div>
                    </div>
                </li>
                <!--Blog Three Single End-->
            @endforeach
        </ul>

        <!-- Pagination -->
        <div class="row">
            <div class="col-xl-12">
                <div class="blog-list__pagination">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
</section>
<!--Blog Page End-->
