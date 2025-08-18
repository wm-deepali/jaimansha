<section class="awards-section mt-5">
    <div class="container">
        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box">
                <div class="section-title__tagline-icon">
                    <i class="icon-like"></i>
                </div>
                <span class="section-title__tagline">Awards & Certificates</span>
            </div>
            <h2 class="section-title__title title-animation">Awards & Certificates</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th style="width: 10%;">S.No.</th>
                        <th>Award Title</th>
                        <th style="width: 10%;">View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($awards as $index => $award)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $award->title }}</td>
                            <td class="text-center">
                                @if($award->image)
                                    <a href="{{ asset('public/uploads/awards/pdfs/' . $award->image) }}" target="_blank">
                                        <img src="https://jaimansha.org/images/pdf.jpg" alt="PDF" width="35">
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if($awards->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No Records Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
