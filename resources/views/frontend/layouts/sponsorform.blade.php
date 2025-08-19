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
            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
                 <select name="state" id="inputSelectState" class="form-select" required>
    <option value="">Select State</option>
    <!-- States will be loaded dynamically -->
</select>
      </div>

            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
        <select name="city" id="inputSelectCity" class="form-select" required>
    <option value="">Select City</option>
</select>
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
