{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success w-100">
        {{ session('success') }}
    </div>
@endif

{{-- Error Messages --}}
@if ($errors->any())
    <div class="alert alert-danger w-100">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-lg-6">
    <div class="comment_form_area p-4 border rounded shadow-sm bg-white">
        <form id="membershipForm" class="row g-3" action="{{ route('frontend.membership_registration.store') }}" method="POST">
            @csrf

            <input type="hidden" name="amount" id="amount">

            <div class="col-md-12">
                <label for="membership_type" class="form-label">Select Membership</label>
                <select id="membership_type" class="form-select" name="package_id" required>
                    <option value="">-- Select Membership --</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" data-amount="{{ $package->amount }}">
                            {{ $package->package_name }} – ₹{{ $package->amount }}{{ $package->validity ? ' / ' . $package->validity : '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input id="first_name" class="form-control" name="first_name" type="text" required>
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input id="last_name" class="form-control" name="last_name" type="text" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email ID</label>
                <input id="email" class="form-control" name="email" type="email" required>
            </div>

            <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input id="mobile" class="form-control" name="mobile" type="text" required pattern="[789][0-9]{9}" title="Enter 10 Digit Mobile Number!">
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
                <label for="dob" class="form-label">Date of Birth</label>
                <input id="dob" class="form-control" name="date_of_birth" type="date" required>
            </div>

            <div class="col-md-12">
                <label for="address" class="form-label">Full Address</label>
                <textarea id="address" class="form-control" name="address" rows="2" required></textarea>
            </div>

            <div class="col-md-6">
                <label for="country" class="form-label">Country</label>
                 @php 
            use App\Models\Country;
      $countries = Country::all(); 
    @endphp
                <select class="form-select" name="country" id="inputSelectCountry" required>
              <option value="">Select Country</option>
                  @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
</select>
            </div>

            
           <div class="col-md-6">
              <label for="state" class="form-label">State</label>
                 <select name="state" id="inputSelectState" class="form-select" required>
    <option value="">Select State</option>
    <!-- States will be loaded dynamically -->
</select>
      </div>
  <div class="col-md-6">
                <label for="city" class="form-label">City</label>
        <select name="city" id="inputSelectCity" class="form-select" required>
    <option value="">Select City</option>
</select>
      </div>
     

            <div class="col-md-6">
                <label for="pincode" class="form-label">Pin Code</label>
                <input id="pincode" class="form-control" name="pin_code" type="text" required>
            </div>

            <div class="col-12 text-center mt-3">
                <button class="btn btn-primary px-5" type="submit">Submit Form</button>
            </div>
        </form>
    </div>
</div>

{{-- JS to auto-set amount --}}
<script>
    document.getElementById('membership_type').addEventListener('change', function () {
        let selected = this.options[this.selectedIndex];
        let amount = selected.getAttribute('data-amount') || 0;
        document.getElementById('amount').value = amount;
    });
</script>

<!-- Include jQuery library if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function() {
    // When country changes
    $("#inputSelectCountry").on("change", function() {
      const countryId = $(this).val();
      console.log("Country selected:", countryId);

      if(countryId) {
        $.ajax({
          url: `/get-states?country_id=${countryId}`,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            let stateOptions = '<option value="">Select State</option>';
            $.each(data.states, function(i, state) {
              stateOptions += `<option value="${state.id}">${state.name}</option>`;
            });
            
$("#inputSelectState").html(stateOptions);
$("#inputSelectState").niceSelect('update');


          },
          error: function(err) {
            console.error("Error fetching states:", err);
          }
        });
      } else {
        $("#inputSelectState").html('<option value="">Select State</option>');
        $("#inputSelectCity").html('<option value="">Select City</option>');
      }
    });

    // When state changes
    $("#inputSelectState").on("change", function() {
      const stateId = $(this).val();
      console.log("State selected:", stateId);

      if(stateId) {
        $.ajax({
          url: `/get-cities?state_id=${stateId}`,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            let cityOptions = '<option value="">Select City</option>';
            $.each(data.cities, function(i, city) {
              cityOptions += `<option value="${city.id}">${city.name}</option>`;
            });
            $("#inputSelectCity").html(cityOptions);
$("#inputSelectCity").niceSelect('update');

          },
          error: function(err) {
            console.error("Error fetching cities:", err);
          }
        });
      } else {
        $("#inputSelectCity").html('<option value="">Select City</option>');
      }
    });
  });
</script>