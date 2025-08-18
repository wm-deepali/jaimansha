<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="bg-white p-4 rounded shadow">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- {{-- Error Message --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->

            <form action="{{ route('frontend.sponsorship_registation.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-12">
                    <label for="sponsorship_type" class="form-label">Sponsor For</label>
                    <select id="sponsorship_type" class="form-select" name="sponsorship_type" required>
                        <option value="">-- Select Type --</option>
                        <option value="Event">Event</option>
                        <option value="Scholarship">Scholarship</option>
                        <option value="Education">Education</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input id="full_name" class="form-control" name="full_name" type="text" placeholder="Full Name" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email ID</label>
                    <input id="email" class="form-control" name="email" type="email" placeholder="Email ID" required>
                </div>

                <div class="col-md-6">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input id="mobile" class="form-control" name="mobile" type="text" placeholder="Mobile Number" pattern="[789][0-9]{9}" title="Enter 10 Digit Mobile Number!" required>
                </div>

                <div class="col-md-6">
                    <label for="company_name" class="form-label">Company / Institutional Name</label>
                    <input id="company_name" class="form-control" name="company_name" type="text" placeholder="Company / Institution">
                </div>

                <div class="col-md-12">
                    <label for="address" class="form-label">Full Address</label>
                    <textarea id="address" class="form-control" name="address" rows="2" placeholder="Full Address" required></textarea>
                </div>

                <div class="col-md-4">
                    <label for="country" class="form-label">Country</label>
                    <input id="country" class="form-control" name="country" type="text" placeholder="Country" required>
                </div>

                <div class="col-md-4">
                    <label for="state" class="form-label">State</label>
                    <input id="state" class="form-control" name="state" type="text" placeholder="State" required>
                </div>

                <div class="col-md-4">
                    <label for="city" class="form-label">City</label>
                    <input id="city" class="form-control" name="city" type="text" placeholder="City" required>
                </div>

                <div class="col-md-6">
                    <label for="pincode" class="form-label">Pin Code</label>
                    <input id="pincode" class="form-control" name="pincode" type="text" placeholder="Pin Code" required>
                </div>

                <div class="col-md-12">
                    <label for="detail" class="form-label">Enter Detail</label>
                    <textarea id="detail" class="form-control" name="detail" rows="4" placeholder="Enter details about your sponsorship interest..." required></textarea>
                </div>

                <div class="col-12 text-center mt-3">
                    <button class="btn btn-primary px-5" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
