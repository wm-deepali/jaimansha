<style>
    .table th, .table td {
    vertical-align: middle;
    padding: 12px;
}
.table thead th {
    font-weight: bold;
    font-size: 16px;
}

</style>
<!-- Management Committee Table Start -->
<section class="event-one event-one--event">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4 text-center">Member Of Managing Committee</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th style="width: 50%;">Name</th>
                                <th style="width: 50%;">Designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($member as $members)
                                <tr>
                                    <td>{{ $members->name }}</td>
                                    <td>{{ $members->designation }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No Records Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Management Committee Table End -->
