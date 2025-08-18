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
                <h2> Complaints and Suggestion</h2>
                <div class="thm-breadcrumb__box">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{route('frontend.home')}}"><i class="fas fa-home"></i>Home</a></li>
                        <li><span class="icon-right-arrow-1"></span></li>
                        <li>Complaints and Suggestion</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header  End-->


    <section class="complaint-suggestions-section py-5">
        <div class="container">
            <h3 class="mb-4">Complaint & Suggestions</h3>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
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

            <form action="{{ route('frontend.complaint_suggestions.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-12">
                    <label for="type" class="form-label">Select Type <span class="text-danger">*</span></label>
                    <select id="type" name="type" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="complaint" {{ old('type') == 'complaint' ? 'selected' : '' }}>Raise a Complaint
                        </option>
                        <option value="suggestion" {{ old('type') == 'suggestion' ? 'selected' : '' }}>Give
                            Suggestions</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input id="full_name" name="full_name" type="text" class="form-control" required maxlength="150"
                        value="{{ old('full_name') }}">
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email Id <span class="text-danger">*</span></label>
                    <input id="email" name="email" type="email" class="form-control" required maxlength="150"
                        value="{{ old('email') }}">
                </div>

                <div class="col-md-6">
                    <label for="mobile_number" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input id="mobile_number" name="mobile_number" type="text" class="form-control" required maxlength="20"
                        value="{{ old('mobile_number') }}">
                </div>

                <div class="col-md-12">
                    <label for="details" class="form-label">Details <span class="text-danger">*</span></label>
                    <textarea id="details" name="details" rows="5" class="form-control" required
                        placeholder="Write your complaint or suggestion here...">{{ old('details') }}</textarea>
                </div>

                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary px-5">Submit</button>
                </div>
            </form>
        </div>
    </section>

@endsection