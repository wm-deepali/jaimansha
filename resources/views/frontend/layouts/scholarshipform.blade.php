{{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

<div class="col-lg-12">
    <div class="">
        <form id="scholarshipForm" class="row g-3" action="{{ route('frontend.scholarship.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

              <!-- Hidden scholarship_id field -->
    <input type="hidden" name="scholarship_id" value="{{ $form->id }}">

            <div class="col-md-6">
                <label for="full_name" class="form-label">Full Name</label>
                <input id="full_name" class="form-control" name="full_name" placeholder="Full Name" type="text" required>
            </div>

            <div class="col-md-6">
                <label for="father_name" class="form-label">Father's Name</label>
                <input id="father_name" class="form-control" name="father_name" placeholder="Father's Name" type="text" required>
            </div>

            <div class="col-md-6">
                <label for="mother_name" class="form-label">Mother's Name</label>
                <input id="mother_name" class="form-control" name="mother_name" placeholder="Mother's Name" type="text" required>
            </div>

            <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input id="dob" class="form-control" name="dob" type="date" required>
            </div>

            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" class="form-select" name="gender" required>
                    <option value="">-- Select Gender --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email ID</label>
                <input id="email" class="form-control" name="email" type="email" placeholder="Email ID" required>
            </div>

            <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input id="mobile" class="form-control" name="mobile" type="text" placeholder="Mobile Number" required pattern="[789][0-9]{9}" title="Enter 10 Digit Mobile Number!">
            </div>

            <div class="col-md-6">
                <label for="school_name" class="form-label">School / Institution Name</label>
                <input id="school_name" class="form-control" name="school_name" type="text" placeholder="School / Institution Name" required>
            </div>

            <div class="col-md-6">
                <label for="studying_in" class="form-label">Studying In (Class/Course)</label>
                <input id="studying_in" class="form-control" name="studying_in" type="text" placeholder="e.g. Class 10 / B.A. 2nd Year" required>
            </div>

            <div class="col-md-6">
                <label for="income" class="form-label">Family Income (Annual)</label>
                <input id="income" class="form-control" name="income" type="text" placeholder="e.g. ₹1,50,000" required>
            </div>

            <div class="col-md-12">
                <label for="address" class="form-label">Full Address</label>
                <textarea id="address" class="form-control" name="address" rows="2" placeholder="Full Address" required></textarea>
            </div>

            <div class="col-md-4">
                <label for="country" class="form-label">Country</label>
                <input id="country" class="form-control" name="country" placeholder="Country" type="text" required>
            </div>

            <div class="col-md-4">
                <label for="state" class="form-label">State</label>
                <input id="state" class="form-control" name="state" placeholder="State" type="text" required>
            </div>

            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input id="city" class="form-control" name="city" placeholder="City" type="text" required>
            </div>

            <div class="col-md-6">
                <label for="pincode" class="form-label">Pin Code</label>
                <input id="pincode" class="form-control" name="pincode" placeholder="Pin Code" type="text" required>
            </div>

            <div class="col-md-6">
                <label for="scholarship_amount" class="form-label">Scholarship Amount</label>
                <input id="scholarship_amount" class="form-control" name="scholarship_amount" type="text" placeholder="Amount requested (₹)" required>
            </div>

            <div class="col-md-12">
                <label for="purpose" class="form-label">Scholarship Purpose</label>
                <textarea id="purpose" class="form-control" name="purpose" rows="3" placeholder="Describe the purpose of scholarship" required></textarea>
            </div>

            <div class="col-md-12">
                <label for="document" class="form-label">Upload Document (If any)</label>
                <input id="document" class="form-control" name="document" type="file" accept=".pdf,.jpg,.jpeg,.png">
            </div>

            <div class="col-12 text-center mt-3">
                <button class="btn btn-primary px-5" type="submit">Submit Form</button>
            </div>
        </form>
    </div>
</div>
