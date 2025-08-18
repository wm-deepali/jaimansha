@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Membership Page Content</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContentModal">
            Add Membership
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Membership Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Pin Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enquiries as $member)
                    <tr>
                        <td>{{ $member->package->package_name ?? 'N/A' }}</td>
                        <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->mobile }}</td>
                        <td>{{ $member->gender }}</td>
                        <td>{{ $member->date_of_birth }}</td>
                        <td>{{ $member->address }}</td>
                        <td>{{ $member->country }}</td>
                        <td>{{ $member->state }}</td>
                        <td>{{ $member->city }}</td>
                        <td>{{ $member->pin_code }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary editBtn"
                                data-id="{{ $member->id }}"
                                data-package_id="{{ $member->package_id }}"
                                data-first_name="{{ $member->first_name }}"
                                data-last_name="{{ $member->last_name }}"
                                data-email="{{ $member->email }}"
                                data-mobile="{{ $member->mobile }}"
                                data-gender="{{ $member->gender }}"
                                data-date_of_birth="{{ $member->date_of_birth }}"
                                data-address="{{ $member->address }}"
                                data-country="{{ $member->country }}"
                                data-state="{{ $member->state }}"
                                data-city="{{ $member->city }}"
                                data-pin_code="{{ $member->pin_code }}"
                                data-content="{{ $member->content }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editMembershipModal">
                                Edit
                            </button>

                          <form action="{{ route('admin.membership.enquiry.delete', $member->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addContentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.membership.enquiry.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Membership</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Membership Package</label>
                            <select name="package_id" class="form-select" required>
                                <option value="">Select Package</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>State</label>
                            <input type="text" name="state" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>City</label>
                            <input type="text" name="city" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Pin Code</label>
                            <input type="text" name="pin_code" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label>Content</label>
                            <textarea name="content" rows="3" class="form-control rich-editor"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editMembershipModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="POST" id="editMembershipForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Membership</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Membership Package</label>
                            <select name="package_id" id="edit-package_id" class="form-select" required>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" id="edit-first_name" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="edit-last_name" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Mobile</label>
                            <input type="text" name="mobile" id="edit-mobile" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Gender</label>
                            <input type="text" name="gender" id="edit-gender" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" id="edit-date_of_birth" class="form-control">
                        </div>

                        <div class="col-12">
                            <label>Address</label>
                            <input type="text" name="address" id="edit-address" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Country</label>
                            <input type="text" name="country" id="edit-country" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>State</label>
                            <input type="text" name="state" id="edit-state" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>City</label>
                            <input type="text" name="city" id="edit-city" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Pin Code</label>
                            <input type="text" name="pin_code" id="edit-pin_code" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label>Content</label>
                            <textarea name="content" id="edit-content" rows="3" class="form-control rich-editor"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-package_id').value = this.dataset.package_id;
            document.getElementById('edit-first_name').value = this.dataset.first_name;
            document.getElementById('edit-last_name').value = this.dataset.last_name;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-mobile').value = this.dataset.mobile;
            document.getElementById('edit-gender').value = this.dataset.gender;
            document.getElementById('edit-date_of_birth').value = this.dataset.date_of_birth;
            document.getElementById('edit-address').value = this.dataset.address;
            document.getElementById('edit-country').value = this.dataset.country;
            document.getElementById('edit-state').value = this.dataset.state;
            document.getElementById('edit-city').value = this.dataset.city;
            document.getElementById('edit-pin_code').value = this.dataset.pin_code;
            document.getElementById('edit-content').value = this.dataset.content;

            document.getElementById('editMembershipForm').action = `/admin/membership/enquiry/update/${id}`;
        });
    });
</script>
@endsection
