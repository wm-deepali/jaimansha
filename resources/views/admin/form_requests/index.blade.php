@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Form Requests</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFormRequestModal">
            + Add Form Request
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($formRequests as $req)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->email }}</td>
                    <td>{!! $req->text !!}</td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $req->id }}"
                            data-name="{{ $req->name }}"
                            data-email="{{ $req->email }}"
                            data-text="{{ $req->text }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editFormRequestModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.form_requests.destroy', $req->id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No form requests found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Form Request Modal -->
<div class="modal fade" id="addFormRequestModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.form_requests.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5>Add Form Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label>Name</label>
                <input type="text" name="name" class="form-control mb-2" required>
                <label>Email</label>
                <input type="email" name="email" class="form-control mb-2" required>
                <label>Text</label>
                <textarea name="text" class="form-control rich-editor" required></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Form Request Modal -->
<div class="modal fade" id="editFormRequestModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="editFormRequestForm" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5>Edit Form Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label>Name</label>
                <input type="text" name="name" id="edit-name" class="form-control mb-2" required>
                <label>Email</label>
                <input type="email" name="email" id="edit-email" class="form-control mb-2" required>
                <label>Text</label>
                <textarea name="text" id="edit-text" class="form-control rich-editor" required></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- JS for Edit Modal -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-text').value = this.dataset.text;
            document.getElementById('editFormRequestForm').action = `/admin/form-requests/${id}`;
        });
    });
</script>
@endsection
