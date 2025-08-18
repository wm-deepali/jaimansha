<!--Blog One Start -->
<section class="blog-one">
    <div class="blog-one__bg" style="background-image: url({{ asset('frontend/admin/assets/images/backgrounds/blog-one-bg.jpg') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-8">
                <div class="blog-one__left">
                    <div class="section-title text-left sec-title-animation animation-style2">
                        <div class="section-title__tagline-box">
                            <div class="section-title__tagline-icon">
                                <i class="icon-like"></i>
                            </div>
                            <span class="section-title__tagline">Blog & Article</span>
                        </div>
                        <h2 class="section-title__title title-animation">Check Latests Blog Post</h2>
                    </div>
                    <div class="blog-one__newsletter">
                        <h4 class="blog-one__newsletter-title">Newsletter</h4>
                        <p class="blog-one__newsletter-text">Subscribe to receive news & updates.</p>
                    <form id="newsletterForm" class="blog-one__newsletter-form">
                            @csrf
                            <div class="blog-one__newsletter-input">
                                <input type="email" name="email" placeholder="Email Address" required>
                                <div class="blog-one__newsletter-input-icon">
                                    <span class="icon-mail"></span>
                                </div>
                            </div>
                            <div class="checked-box">
                                <input type="checkbox" name="agree_terms" id="skipper" checked>
                                <label for="skipper"><span></span>I agree to the terms & Conditions</label>
                            </div>
                            <button type="submit" class="thm-btn blog-one__newsletter-btn">
                                Subscribe Now
                                <span class="icon-arrow-right"></span>
                                <i></i>
                            </button>
                            <div id="newsletter-message" style="margin-top:10px;"></div>
                        </form>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#newsletterForm').on('submit', function(e) {
                                    e.preventDefault();

                                    let formData = $(this).serialize();

                                    $.ajax({
                                        url: "{{ route('admin.newsletters.store') }}", // ya aapka correct route
                                        type: "POST",
                                        data: formData,
                                        beforeSend: function() {
                                            $('#newsletter-message').html('<span style="color:blue;">Submitting...</span>');
                                        },
                                        success: function(response) {
                                            $('#newsletter-message').html('<span style="color:green;">Subscribed successfully!</span>');
                                            $('#newsletterForm')[0].reset();
                                        },
                                        error: function(xhr) {
                                            if (xhr.status === 422) {
                                                let errors = xhr.responseJSON.errors;
                                                let errorHtml = '<ul style="color:red;">';
                                                $.each(errors, function(key, value) {
                                                    errorHtml += '<li>' + value[0] + '</li>';
                                                });
                                                errorHtml += '</ul>';
                                                $('#newsletter-message').html(errorHtml);
                                            } else {
                                                $('#newsletter-message').html('<span style="color:red;">Something went wrong!</span>');
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="blog-one__right">
                    <div class="blog-one__carousel owl-theme owl-carousel">
                        @foreach($blogs as $blog)
                        <!--Blog One Single Start -->
                        <div class="item">
                            <div class="blog-one__single">
                                <div class="blog-one__tag">
                                    <div class="blog-one__tag-icon">
                                        <span class="icon-folder"></span>
                                    </div>
                                    <p class="blog-one__tag-text">{{ $blog->category->category_name ?? 'Uncategorized' }}</p>
                                </div>
                                <div class="blog-one__img">
@if($blog->banner_image)
    <img src="{{ asset('public/' . $blog->banner_image) }}" alt="Blog Banner">
@else
    <img src="{{ asset('frontend/admin/assets/images/default-image.jpg') }}" alt="Default">
@endif


                                    

                                    <div class="blog-one__date">
                                        <h4>{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}</h4>
                                        <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M') }}</p>
                                    </div>
                                </div>
                                
                                <div class="blog-one__content">
                                    <h3 class="blog-one__title">
                                        <a href="#">
                                            <p class="">{{ $blog->title ?? 'Uncategorized' }}</p>
                                            <br>
                                            <!--{!! $blog->short_description !!}-->
                                        </a>
                                    </h3>
                                <div class="blog-one__shape">
    @if(!$blog->thumbnail_image)
        <img src="{{ asset('public/' . $blog->thumbnail_image) }}" alt="Blog Banner">
    @else
        <img src="{{ asset('frontend/admin/assets/images/shapes/blog-one-shape-1.png') }}" alt="Default Banner">
    @endif
</div>

                                   <p class="blog-one__text">
    {!! \Illuminate\Support\Str::words(strip_tags($blog->detail_content), 30, '...') !!}
</p>

                                    <div class="blog-one__user-and-btn-box">
                                        <div class="blog-one__user">
                                            <div class="blog-one__user-icon">
                                                <span class="icon-account"></span>
                                            </div>
                                            <p class="blog-one__user-text">{{ $blog->category->written_by ?? 'Admin' }}</p>
                                        </div>
                                        <div class="blog-one__btn-box">
                                         <a href="{{ route('frontend.blog_details.index', $blog->slug) }}" class="blog-one__btn thm-btn">
    More Details
    <span class="icon-arrow-right"></span><i></i>
</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Blog One Single End -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Blog One End -->
