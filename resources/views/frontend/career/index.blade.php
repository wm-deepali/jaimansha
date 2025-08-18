@extends('frontend.layouts.news')

@section('content')
<style>
    .job-card {
        border: 1px solid #e5e5e5;
        transition: all 0.2s ease-in-out;
    }
    .job-card:hover {
        border-color: #007bff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    .job-card h5 {
        font-size: 1.25rem;
    }
</style>
<section class="career-page py-5">
    <div class="container">
        <div class="row">
            
            {{-- Left: Job Openings --}}
            {{-- Left: Job Openings --}}
<div class="col-lg-7">
    <h3 class="mb-4 fw-bold">Current Openings</h3>

    {{-- Job Card 1 --}}
    <div class="job-card p-4 mb-3 shadow-sm rounded">
        <h5 class="mb-3 fw-bold text-primary">Software Developer</h5>
        <ul class="list-unstyled mb-0">
            <li class="mb-2">
                <i class="bi bi-mortarboard-fill text-secondary me-2"></i>
                <strong>Qualification:</strong> B.Tech in Computer Science
            </li>
            <li class="mb-2">
                <i class="bi bi-geo-alt-fill text-secondary me-2"></i>
                <strong>Job Location:</strong> New Delhi
            </li>
            <li>
                <i class="bi bi-people-fill text-secondary me-2"></i>
                <strong>No. of Candidates:</strong> 3
            </li>
        </ul>
    </div>

    {{-- Job Card 2 --}}
    <div class="job-card p-4 mb-3 shadow-sm rounded">
        <h5 class="mb-3 fw-bold text-primary">Marketing Executive</h5>
        <ul class="list-unstyled mb-0">
            <li class="mb-2">
                <i class="bi bi-mortarboard-fill text-secondary me-2"></i>
                <strong>Qualification:</strong> MBA in Marketing
            </li>
            <li class="mb-2">
                <i class="bi bi-geo-alt-fill text-secondary me-2"></i>
                <strong>Job Location:</strong> Mumbai
            </li>
            <li>
                <i class="bi bi-people-fill text-secondary me-2"></i>
                <strong>No. of Candidates:</strong> 2
            </li>
        </ul>
    </div>

    {{-- Job Card 3 --}}
    <div class="job-card p-4 mb-3 shadow-sm rounded">
        <h5 class="mb-3 fw-bold text-primary">Graphic Designer</h5>
        <ul class="list-unstyled mb-0">
            <li class="mb-2">
                <i class="bi bi-mortarboard-fill text-secondary me-2"></i>
                <strong>Qualification:</strong> Diploma in Graphic Design
            </li>
            <li class="mb-2">
                <i class="bi bi-geo-alt-fill text-secondary me-2"></i>
                <strong>Job Location:</strong> Bangalore
            </li>
            <li>
                <i class="bi bi-people-fill text-secondary me-2"></i>
                <strong>No. of Candidates:</strong> 1
            </li>
        </ul>
    </div>
</div>

{{-- Styles --}}



            {{-- Right: Job Application Form --}}
            <div class="col-lg-5">
                <h3 class="mb-4">Apply Now</h3>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control" placeholder="Enter your phone number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Resume</label>
                                <input type="file" name="resume" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="3" placeholder="Write a short message..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
