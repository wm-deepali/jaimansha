@extends('frontend.layouts.master')

@section('title', ' ')

<style>
  /* Volunteer form container */
  .form-wrapper {
    background: #fff;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    margin-bottom: 40px;
  }

  .form-wrapper:hover {
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
  }

  /* Form labels */
  .form-wrapper label {
    font-weight: 600;
    color: #2c3e50;
  }

  /* Inputs, selects, textareas */
  .form-wrapper .form-control,
  .form-wrapper .form-select {
    border-radius: 8px;
    border: 1.4px solid #ced4da;
    padding: 10px 14px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }

  .form-wrapper .form-control:focus,
  .form-wrapper .form-select:focus {
    border-color: #0d6efd;
    box-shadow: none;
  }

  /* Textarea placeholders */
  .form-wrapper textarea::placeholder {
    color: #6c757d;
    opacity: 1;
  }

  /* Submit button */
  .form-wrapper button.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-weight: 600;
    padding: 12px 50px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
  }

  .form-wrapper button.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0b5ed7;
    box-shadow: 0 8px 25px rgba(11, 94, 215, 0.4);
  }

  /* Responsive fix for small devices */
  @media (max-width: 576px) {
    .form-wrapper {
      padding: 20px 15px;
    }
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
      <h2> Become Volunteers</h2>
      <div class="thm-breadcrumb__box">
      <ul class="thm-breadcrumb list-unstyled">
        <li><a href="{{route('frontend.home')}}"><i class="fas fa-home"></i>Home</a></li>
        <li><span class="icon-right-arrow-1"></span></li>
        <li>Volunteers</li>
      </ul>
      </div>
    </div>
    </div>
  </section>
  <!--Page Header  End-->
  <section class="volunteer-form-section py-5">
    <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
      <div class="p-4 bg-white rounded shadow-sm">

        {{-- Success Message --}}
        @if(session('success'))
      <div class="alert alert-success">
      {{ session('success') }}
      </div>
      @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
      <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
      @endif


        <form action="{{ route('frontend.become_volunteers.store') }}" method="POST" enctype="multipart/form-data"
        class="row g-3">
        @csrf

        <div class="col-md-12">
          <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
          <input id="full_name" class="form-control" name="full_name" type="text" required maxlength="150"
          value="{{ old('full_name') }}">
        </div>

        <div class="col-md-12">
          <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
          <input id="email" class="form-control" name="email" type="email" required maxlength="150"
          value="{{ old('email') }}">
        </div>

        <div class="col-md-12">
          <label for="mobile_number" class="form-label">Mobile Number <span class="text-danger">*</span></label>
          <input id="mobile_number" class="form-control" name="mobile_number" type="text" required maxlength="20"
          value="{{ old('mobile_number') }}">
        </div>

        <div class="col-md-12">
          <label for="address" class="form-label">Address</label>
          <textarea id="address" class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
        </div>

        <div class="col-md-6">
          <label for="date_of_birth" class="form-label">Date of Birth</label>
          <input id="date_of_birth" class="form-control" name="date_of_birth" type="date"
          value="{{ old('date_of_birth') }}">
        </div>

        <div class="col-md-6">
          <label for="gender" class="form-label">Gender</label>
          <select id="gender" class="form-select" name="gender">
          <option value="">-- Select Gender --</option>
          <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
          <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <div class="col-md-12">
          <label for="skills" class="form-label">Skills</label>
          <textarea id="skills" class="form-control" name="skills" rows="3"
          placeholder="Mention your skills">{{ old('skills') }}</textarea>
        </div>

        <div class="col-md-12">
          <label for="availability" class="form-label">Availability</label>
          <textarea id="availability" class="form-control" name="availability" rows="3"
          placeholder="Your availability details">{{ old('availability') }}</textarea>
        </div>

        <div class="col-md-12">
          <label for="motivation" class="form-label">Motivation</label>
          <textarea id="motivation" class="form-control" name="motivation" rows="3"
          placeholder="Why do you want to volunteer?">{{ old('motivation') }}</textarea>
        </div>

        <div class="col-md-12">
          <label for="experience" class="form-label">Experience</label>
          <textarea id="experience" class="form-control" name="experience" rows="3"
          placeholder="Any previous volunteering experience">{{ old('experience') }}</textarea>
        </div>

        <div class="col-md-6">
          <label for="emergency_contact" class="form-label">Emergency Contact Name</label>
          <input id="emergency_contact" class="form-control" name="emergency_contact" type="text" maxlength="100"
          value="{{ old('emergency_contact') }}">
        </div>

        <div class="col-md-6">
          <label for="emergency_mobile" class="form-label">Emergency Mobile Number</label>
          <input id="emergency_mobile" class="form-control" name="emergency_mobile" type="text" maxlength="20"
          value="{{ old('emergency_mobile') }}">
        </div>

        <div class="col-md-12">
          <label for="resume_file" class="form-label">Upload Resume (PDF, DOC, DOCX, max 2MB)</label>
          <input id="resume_file" class="form-control" name="resume_file" type="file" accept=".pdf,.doc,.docx">
        </div>

        <div class="col-12 text-center mt-3">
          <button class="btn btn-primary px-5" type="submit">Submit Volunteer Form</button>
        </div>
        </form>
      </div>
      </div>
    </div>
  </section>

@endsection