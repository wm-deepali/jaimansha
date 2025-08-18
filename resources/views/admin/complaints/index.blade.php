@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Complaints & Suggestions</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addComplaintModal">
            Add New
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Type</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Details</th>
                    <th>Submitted At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($complaints as $complaint)
                <tr>
                    <td>{{ ucfirst($complaint->type) }}</td>
                    <td>{{ $complaint->full_name }}</td>
                    <td>{{ $complaint->email }}</td>
                    <td>{{ $complaint->mobile_number }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($complaint->details, 100) }}</td>
                    <td>{{ $complaint->created_at->format('d M Y, h:i A') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $complaint->id }}"
                            data-type="{{ $complaint->type }}"
                            data-full_name="{{ $complaint->full_name }}"
                            data-email="{{ $complaint->email }}"
                            data-mobile_number="{{ $complaint->mobile_number }}"
                            data-details="{{ $complaint->details }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editComplaintModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.complaints.destroy', $complaint->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addComplaintModal" tabindex="-1" aria-labelledby="addComplaintModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.complaints.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Complaint / Suggestion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Type</label>
                            <select name="type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="complaint">Raise a Complaint</option>
                                <option value="suggestion">Give Suggestions</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile_number" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Details</label>
                            <textarea name="details" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editComplaintModal" tabindex="-1" aria-labelledby="editComplaintModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editComplaintForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Complaint / Suggestion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Type</label>
                            <select name="type" id="edit-type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="complaint">Raise a Complaint</option>
                                <option value="suggestion">Give Suggestions</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="full_name" id="edit-full_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile_number" id="edit-mobile_number" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Details</label>
                            <textarea name="details" id="edit-details" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS for Edit button --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const data = this.dataset;

            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-type').value = data.type;
            document.getElementById('edit-full_name').value = data.full_name;
            document.getElementById('edit-email').value = data.email;
            document.getElementById('edit-mobile_number').value = data.mobile_number;
            document.getElementById('edit-details').value = data.details;

            document.getElementById('editComplaintForm').action = `/admin/complaints/update/${data.id}`;
        });
    });
</script>
@endsection
