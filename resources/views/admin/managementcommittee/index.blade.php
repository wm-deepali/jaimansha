@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Management Committee</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">+ Add Member</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Member Name</th>
                <th>Designation</th>
                <th>Category</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $key => $member)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->designation }}</td>
                    <td>{{ $member->category->member_category ?? 'N/A' }}</td>
                    <td>
                      @if($member->image)
    <img src="{{ asset('public/'.$member->image) }}" width="50" alt="Image">
@else
    <span>No Image</span>
@endif
                    </td>
                    <td>{{ $member->status }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn"
                                data-id="{{ $member->id }}"
                                data-name="{{ $member->name }}"
                                data-designation="{{ $member->designation }}"
                                data-category="{{ $member->member_category }}"
                                data-status="{{ $member->status }}"
                                data-image="{{ $member->image }}"
                                data-bs-toggle="modal" data-bs-target="#editMemberModal">
                            Edit
                        </button>
                        <form action="{{ route('admin.managementcommittee.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this member?')">
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

<!-- Add Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.managementcommittee.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Member Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select name="member_category" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->member_category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" accept="image/*" class="form-control">
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title">Edit Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="edit-id">
            <div class="mb-3">
                <label>Member Name</label>
                <input type="text" name="name" id="edit-name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Designation</label>
                <input type="text" name="designation" id="edit-designation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select name="member_category" id="edit-category" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->member_category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <br>
                <img id="edit-preview" src="" width="70" alt="No Image">
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" id="edit-status" class="form-select" required>
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
  </div>
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editBtn');
    const editForm = document.getElementById('editForm');
    const previewImg = document.getElementById('edit-preview');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const designation = this.dataset.designation;
            const category = this.dataset.category;
            const status = this.dataset.status;
            const image = this.dataset.image;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-designation').value = designation;
            document.getElementById('edit-category').value = category;
            document.getElementById('edit-status').value = status;

            previewImg.src = image ? `/uploads/committee/${image}` : '';
            editForm.action = `/admin/content/management-committee/update/${id}`;
        });
    });
});
</script>
@endsection
