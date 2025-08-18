@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Membership Registered</h4>

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Member Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Package Name</th>
                    <th>Valid Through</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    @if (!empty($member->email))
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($member->created_at)->format('d-m-Y h:i A') }}</td>
                            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->mobile }}</td>
                            <td>{{ $member->membership_type }}</td>
                            <td>{{ $member->package->duration ?? 'NA' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-primary editBtn"
                                    data-id="{{ $member->id }}"
                                    data-first_name="{{ $member->first_name }}"
                                    data-last_name="{{ $member->last_name }}"
                                    data-email="{{ $member->email }}"
                                    data-mobile="{{ $member->mobile }}"
                                    data-gender="{{ $member->gender }}"
                                    data-date_of_birth="{{ $member->date_of_birth }}"
                                    data-membership_type="{{ $member->membership_type }}"
                                    data-address="{{ $member->address }}"
                                    data-country="{{ $member->country }}"
                                    data-state="{{ $member->state }}"
                                    data-city="{{ $member->city }}"
                                    data-pin_code="{{ $member->pin_code }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.membership.registered.delete', $member->id) }}" 
                                      method="POST" 
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="edit-first_name">
                        </div>

                        <div class="mb-3">
                            <label for="edit-last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="edit-last_name">
                        </div>

                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="edit-email">
                        </div>

                        <div class="mb-3">
                            <label for="edit-mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="edit-mobile">
                        </div>

                        <div class="mb-3">
                            <label for="edit-gender" class="form-label">Gender</label>
                            <select class="form-control" name="gender" id="edit-gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" id="edit-date_of_birth">
                        </div>

                        <div class="mb-3">
                            <label for="edit-membership_type" class="form-label">Membership Type</label>
                            <input type="text" class="form-control" name="membership_type" id="edit-membership_type">
                        </div>

                        <div class="mb-3">
                            <label for="edit-address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="edit-address" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-country" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" id="edit-country">
                        </div>

                        <div class="mb-3">
                            <label for="edit-state" class="form-label">State</label>
                            <input type="text" class="form-control" name="state" id="edit-state">
                        </div>

                        <div class="mb-3">
                            <label for="edit-city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" id="edit-city">
                        </div>

                        <div class="mb-3">
                            <label for="edit-pin_code" class="form-label">Pin Code</label>
                            <input type="text" class="form-control" name="pin_code" id="edit-pin_code">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript for Modal --}}
<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit-id').value = this.dataset.id;
            document.getElementById('edit-first_name').value = this.dataset.first_name;
            document.getElementById('edit-last_name').value = this.dataset.last_name;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-mobile').value = this.dataset.mobile;
            document.getElementById('edit-gender').value = this.dataset.gender;
            document.getElementById('edit-date_of_birth').value = this.dataset.date_of_birth;
            document.getElementById('edit-membership_type').value = this.dataset.membership_type;

            // New address related fields
            document.getElementById('edit-address').value = this.dataset.address || '';
            document.getElementById('edit-country').value = this.dataset.country || '';
            document.getElementById('edit-state').value = this.dataset.state || '';
            document.getElementById('edit-city').value = this.dataset.city || '';
            document.getElementById('edit-pin_code').value = this.dataset.pin_code || '';

            // Set form action dynamically
            document.getElementById('editForm').action = `/admin/membership/registered/update/${this.dataset.id}`;
        });
    });
</script>
@endsection
