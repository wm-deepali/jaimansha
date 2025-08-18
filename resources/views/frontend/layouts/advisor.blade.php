<!-- Our Advisors Table Start -->
<section class="advisors-section">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="section-title__title">Our Advisors</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <!--<th>Designation</th>-->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($advisors as $te)
                        @if($te->team_type === 'advisor' && $te->status === 'active')
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $te->name }}</td>
                                <!--<td>{{ $te->designation ?? 'Advisor' }}</td>-->
                                <td>
                                    @if($te->image)
                                        <a href="{{ asset('public/uploads/team/pdfs/' . $te->image) }}" target="_blank" class="btn btn-warning btn-sm">
                                            View Profile
                                        </a>
                                    @else
                                        <span class="text-muted">No PDF</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Our Advisors Table End -->

