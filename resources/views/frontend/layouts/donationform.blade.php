<!-- Donation Form -->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="col-lg-6">
  <div class="comment_form_area p-4 border rounded shadow-sm bg-white">
    <form id="donationForm" action="{{ route('frontend.donate_us.store') }}" method="POST" class="row g-3">
      @csrf

      <div class="col-md-12">
        <label for="donation_for" class="form-label">Donation For</label>
        <select id="donation_for" class="form-select" name="donation_for" required>
          <option value="">-- Select Donation For --</option>

          @foreach($donors->unique('donor_type') as $donor)
        <option value="{{ $donor->donor_type }}">{{ $donor->donor_type }}</option>
      @endforeach

        </select>
      </div>

      <div class="col-md-12">
        <label for="amount" class="form-label">Enter Amount</label>
        <input id="amount" class="form-control" name="amount" placeholder="Enter Amount" type="number" required>
      </div>

      <div class="col-md-6">
        <label for="first_name" class="form-label">Full Name</label>
        <input id="first_name" class="form-control" name="first_name" placeholder="First Name" type="text" required>
      </div>


      <div class="col-md-6">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input id="mobile" class="form-control" name="mobile" placeholder="Mobile Number" type="text" required>
      </div>

      <div class="col-md-6">
        <label for="email" class="form-label">Email ID</label>
        <input id="email" class="form-control" name="email" placeholder="Email ID" type="email" required>
      </div>

      <div class="col-md-12">
        <label for="address" class="form-label">Full Address</label>
        <textarea id="address" class="form-control" name="address" rows="2" placeholder="Full Address"
          required></textarea>
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
   <input id="pincode" class="form-control" name="pincode" placeholder="Pin Code" type="text" required>
      </div>
      
      <div class="col-12 text-center mt-3">
        <button class="btn btn-primary px-5" type="submit">Submit Form</button>
</div>    </form>
  </div>
</div>


<!-- Include jQuery library if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('after-scripts')

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

@endpush
