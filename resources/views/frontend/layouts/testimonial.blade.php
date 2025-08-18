<section class="testimonial-feedback-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h5 class="text-success">Real Stories</h5>
      <h2 class="fw-bold">What Our Users Say About Us</h2>
      <p class="text-muted">Genuine feedback shared by our community members and supporters</p>
    </div>
    <div class="row">
      <!-- Left Side: Feedback Form -->
      <div class="col-lg-5 mb-4">
        <div class="p-4 border rounded bg-white h-100">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-heart-fill text-danger me-2"></i>
            <h6 class="mb-0 text-success">Submit Feedback</h6>
          </div>
          <h2 class="mb-3 fw-bold">We’d love to hear your thoughts</h2>
          @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

        <form action="{{ route('frontend.testimonial.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label class="form-label">Email ID</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="mb-3 col-6">
            <label class="form-label">Mobile Number</label>
            <input type="tel" name="mobile" class="form-control" placeholder="Enter your phone number" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Star Rating</label>
        <div class="d-flex gap-2">
            <input type="radio" name="star_rating" id="star1" value="1"><label for="star1" class="text-warning">★</label>
            <input type="radio" name="star_rating" id="star2" value="2"><label for="star2" class="text-warning">★</label>
            <input type="radio" name="star_rating" id="star3" value="3"><label for="star3" class="text-warning">★</label>
            <input type="radio" name="star_rating" id="star4" value="4"><label for="star4" class="text-warning">★</label>
            <input type="radio" name="star_rating" id="star5" value="5"><label for="star5" class="text-warning">★</label>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Your Feedback</label>
        <textarea name="message" class="form-control" rows="3" placeholder="Share your experience" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Upload Profile Picture</label>
        <input type="file" name="profile_image" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit Feedback</button>
</form>

        </div>
      </div>

      <!-- Right Side: Testimonial Carousel with 4 at a time -->
<div class="col-lg-7">
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($testimonials->where('status', 'published')->chunk(4) as $chunkIndex => $testimonialChunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row g-4">
                        @foreach ($testimonialChunk as $testimonial)
                            <div class="col-md-6">
                                <div class="testimonial-card">
                                    <img src="{{ asset('public/'.$testimonial->profile_picture ?? 'assets/images/testimonial/default.png') }}"
                                         class="rounded-circle mb-2" width="60" height="60" alt="">
                                    
                                    <div class="text-warning mb-1">
                                        {!! str_repeat('★', $testimonial->star_rating) !!}
                                        {!! str_repeat('☆', 5 - $testimonial->star_rating) !!}
                                    </div>

                                    <p class="text-muted small">
                                        {!! $testimonial->message !!}
                                    </p>

                                    <p class="fw-bold mb-0">{{ $testimonial->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

  </div>
</section>
