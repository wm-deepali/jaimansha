  <!--Event One Start -->
  <section class="event-one event-one--event">
      <div class="event-one__shape-1 float-bob-y">
          <img src="assets/images/shapes/event-one-shape-1.png" alt="">
      </div>
      <div class="event-one__shape-2 float-bob-x">
          <img src="assets/images/shapes/event-one-shape-2.png" alt="">
      </div>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2 class="mb-4">Annual Report</h2>
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped text-center align-middle">
                          <thead class="table-dark">
                              <tr>
                                  <th>S.No</th>
                                  <th>Detail</th>
                                  <th>Year</th>
                                  <th>PDF</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($certifications as $index => $cert)
                              @if($cert->type === 'annual_reports')
                              <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>{!! $cert->title !!}</td>
                                  <td>{{ $cert->year }}</td>
                                  <td>
                                      @if($cert->pdf)
                                      <a href="{{ asset('storage/' . $cert->pdf) }}" target="_blank">
                                          <img src="{{ asset('frontend/admin/assets/images/pdf-icon.png') }}" alt="PDF" width="30">
                                      </a>
                                      @else
                                      N/A
                                      @endif
                                  </td>
                              </tr>
                              @endif
                              @endforeach

                              @if($certifications->isEmpty())
                              <tr>
                                  <td colspan="4">No Records Found</td>
                              </tr>
                              @endif
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

  </section>
