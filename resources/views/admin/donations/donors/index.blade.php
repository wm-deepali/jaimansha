@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Donors</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDonorModal">+ Add Donor</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Donor Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Amount</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Donor Type</th>
                    <th>Organization</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donors as $key => $donor)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $donor->full_name }}</td>
                    <td>{{ $donor->email }}</td>
                    <td>{{ $donor->phone }}</td>
                    <td>{{ $donor->address }}</td>
                    <td>{{ $donor->city }}</td>
                    <td>{{ $donor->amount }}</td>
                    <td>{{ $donor->state }}</td>
                    <td>{{ $donor->country }}</td>
                    <td>{{ ucfirst($donor->donor_type) }}</td>
                    <td>{{ $donor->organization_name }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn"
                            data-id="{{ $donor->id }}"
                            data-full_name="{{ $donor->full_name }}"
                            data-email="{{ $donor->email }}"
                            data-phone="{{ $donor->phone }}"
                            data-address="{{ $donor->address }}"
                            data-city="{{ $donor->city }}"
                            data-state="{{ $donor->state }}"
                            data-country="{{ $donor->country }}"
                            data-zip_code="{{ $donor->zip_code }}"
                            data-donor_type="{{ $donor->donor_type }}"
                            data-organization_name="{{ $donor->organization_name }}"
                            data-bs-toggle="modal" data-bs-target="#editDonorModal">Edit</button>

                        <form action="{{ route('admin.donations.donors.destroy', $donor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this donor?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addDonorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.donations.donors.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Donor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>Full Name</label><input type="text" name="full_name" class="form-control" required></div>
                    <div class="col-md-6"><label>Email</label><input type="email" name="email" class="form-control"></div>
                    <div class="col-md-4"><label>Phone</label><input type="text" name="phone" class="form-control"></div>
                    <div class="col-md-4"><label>Address</label><input type="text" name="address" class="form-control"></div>
                    <div class="col-md-4"><label>City</label><input type="text" name="city" class="form-control"></div>
                    <div class="col-md-4"><label>State</label><input type="text" name="state" class="form-control"></div>
                    <div class="col-md-4"><label>Country</label><input type="text" name="country" class="form-control"></div>
                    <div class="col-md-4"><label>Zip Code</label><input type="text" name="zip_code" class="form-control"></div>
                    <div class="col-md-6"><label>Donor Type</label>
                        <select name="donor_type" class="form-control">
                            <option value="individual">Individual</option>
                            <option value="organization">Organization</option>
                        </select>
                    </div>
                    <div class="col-md-6"><label>Organization Name</label><input type="text" name="organization_name" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editDonorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editDonorForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Donor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <!-- Same fields as Add Modal -->
                    <div class="col-md-6"><label>Full Name</label><input type="text" name="full_name" id="edit-full_name" class="form-control"></div>
                    <div class="col-md-6"><label>Email</label><input type="email" name="email" id="edit-email" class="form-control"></div>
                    <div class="col-md-4"><label>Phone</label><input type="text" name="phone" id="edit-phone" class="form-control"></div>
                    <div class="col-md-4"><label>Address</label><input type="text" name="address" id="edit-address" class="form-control"></div>
                    <div class="col-md-4"><label>City</label><input type="text" name="city" id="edit-city" class="form-control"></div>
                    <div class="col-md-4"><label>State</label><input type="text" name="state" id="edit-state" class="form-control"></div>
                    <div class="col-md-4"><label>Country</label><input type="text" name="country" id="edit-country" class="form-control"></div>
                    <div class="col-md-4"><label>Zip Code</label><input type="text" name="zip_code" id="edit-zip_code" class="form-control"></div>
                    <div class="col-md-6"><label>Donor Type</label>
                        <select name="donor_type" id="edit-donor_type" class="form-control">
                            <option value="individual">Individual</option>
                            <option value="organization">Organization</option>
                        </select>
                    </div>
                    <div class="col-md-6"><label>Organization Name</label><input type="text" name="organization_name" id="edit-organization_name" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JS to Populate Edit Modal -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editDonorForm');
            form.action = `/admin/donations/donors/update/${id}`;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-full_name').value = this.dataset.full_name;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-phone').value = this.dataset.phone;
            document.getElementById('edit-address').value = this.dataset.address;
            document.getElementById('edit-city').value = this.dataset.city;
            document.getElementById('edit-state').value = this.dataset.state;
            document.getElementById('edit-country').value = this.dataset.country;
            document.getElementById('edit-zip_code').value = this.dataset.zip_code;
            document.getElementById('edit-donor_type').value = this.dataset.donor_type;
            document.getElementById('edit-organization_name').value = this.dataset.organization_name;
        });
    });
</script>
@endsection
