@extends('frontend.layouts.master')

@section('title', 'Career ||')
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

@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{asset('frontend/admin/assets/images/backgrounds/page-header-bg.jpg')}});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Career</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Career</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->
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
                            <div id="application-success" class="alert alert-success d-none"></div>
                            <form id="careerForm" action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="mb-3">
                                    <label for="applied_post" class="form-label">Select Job Opening</label>
                                    <select name="applied_post" id="applied_post" class="form-select" required>
                                        <option value="">-- Select Job --</option>
                                        <option value="Software Developer">Software Developer</option>
                                        <option value="Marketing Executive">Marketing Executive</option>
                                        <option value="Graphic Designer">Graphic Designer</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="qualification" class="form-label">Qualification</label>
                                    <input type="text" name="qualification" id="qualification" class="form-control"
                                        placeholder="Enter your qualification" required>
                                </div>

                                <div class="mb-3">
                                    <label for="total_experience" class="form-label">Total Experience (years)</label>
                                    <input type="number" name="total_experience" id="total_experience" class="form-control"
                                        placeholder="Enter total experience in years" min="0" required>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter your name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter your email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control"
                                        placeholder="Enter your phone number" required>
                                </div>

                                <div class="mb-3">
                                    <label for="resume" class="form-label">Upload Resume</label>
                                    <input type="file" name="resume" id="resume" class="form-control"
                                        accept=".pdf,.doc,.docx" required>
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="3"
                                        placeholder="Write a short message..."></textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('careerForm');
    const successDiv = document.getElementById('application-success');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        successDiv.classList.add('d-none');
        successDiv.innerText = '';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                successDiv.innerText = data.success;
                successDiv.classList.remove('d-none');
                form.reset(); // Optionally clear the form
            }else if(data.errors){
                // Show validation errors
                let errors = Object.values(data.errors).flat().join('\n');
                successDiv.innerText = errors;
                successDiv.classList.remove('d-none');
                successDiv.classList.remove('alert-success');
                successDiv.classList.add('alert-danger');
            }
        })
        .catch(error => {
            successDiv.innerText = 'Something went wrong. Please try again.';
            successDiv.classList.remove('d-none');
            successDiv.classList.remove('alert-success');
            successDiv.classList.add('alert-danger');
        });
    });
});
</script>
