@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Donation Categories</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ Add Category</button>
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
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        @if($category->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                    <td>
                        <!-- Edit -->
                        <!-- <button
                            class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}"
                            data-status="{{ $category->status }}"
                            data-route="{{ route('admin.donation-category.update', $category->id) }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editCategoryModal">
                            Edit
                        </button> -->

                        <!-- Delete -->
                        <form action="{{ route('admin.donation-category.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.donation-category.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Donation Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>

                    <label class="mt-2">Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Donation Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input type="text" name="name" id="editName" class="form-control" required>

                    <label class="mt-2">Status</label>
                    <select name="status" id="editStatus" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.editBtn');
        const editForm = document.getElementById('editForm');
        const editName = document.getElementById('editName');
        const editStatus = document.getElementById('editStatus');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const name = this.dataset.name;
                const status = this.dataset.status;
                const route = this.dataset.route;

                editForm.action = route;
                editName.value = name;
                editStatus.value = status;
            });
        });
    });
</script>
@endpush
