@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Categories</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ Add Category</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <!-- <th>#</th> -->
                <th>Category Name (Author Type)</th>
                <th>Meta Title</th>
                <th>Meta Keyword</th>
                <th>Meta Description</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
@if(in_array(strtolower($category->author?->author_type), ['publication', 'both']))

                <tr>
                    <!-- <td>{{ $index + 1 }}</td> -->
                    <td>
                        {{ $category->name }}
                        <br>
                        <small class="text-muted">
                            ({{ ucfirst($category->author?->author_type ?? 'N/A') }})
                        </small>
                    </td>
                    <td>{{ $category->meta_title }}</td>
                    <td>{{ $category->meta_keyword }}</td>
                    <td>{{ $category->meta_description }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        @if($category->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <button
                            class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}"
                            data-meta_title="{{ $category->meta_title }}"
                            data-meta_keyword="{{ $category->meta_keyword }}"
                            data-meta_description="{{ $category->meta_description }}"
                            data-slug="{{ $category->slug }}"
                            data-author_id="{{ $category->author_id }}"
                            data-status="{{ $category->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editCategoryModal"
                        >
                            Edit
                        </button>
                            <form action="{{ route('admin.emagazine.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.emagazine.categories.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5>Add Category</h5></div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Author Type</label>
                        <select name="author_id" class="form-control" required>
                            <option value="">Select Author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->author_type }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Meta Keyword</label>
                        <input type="text" name="meta_keyword" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <form id="editCategoryForm" method="POST">
    @csrf
    @method('PUT')

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit-id">

                <div class="mb-3">
                    <label>Category Name</label>
                    <input type="text" id="edit-name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Author Type</label>
                    <select id="edit-author_id" name="author_id" class="form-control">
                        <option value="1">Magazines</option>
                        <option value="2">Publications</option>
                        <option value="3">Both</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Meta Title</label>
                    <input type="text" id="edit-meta_title" name="meta_title" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Meta Keyword</label>
                    <input type="text" id="edit-meta_keyword" name="meta_keyword" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Meta Description</label>
                    <textarea id="edit-meta_description" name="meta_description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text" id="edit-slug" name="slug" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select id="edit-status" name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </form>
  </div>
</div>


<!-- Script to populate edit modal -->
<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editCategoryForm');

            // Set dynamic action URL
            form.action = `/admin/emagazine/categories/update/${id}`;


            // Fill modal form values
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-meta_title').value = this.dataset.meta_title;
            document.getElementById('edit-meta_keyword').value = this.dataset.meta_keyword;
            document.getElementById('edit-meta_description').value = this.dataset.meta_description;
            document.getElementById('edit-slug').value = this.dataset.slug;
            document.getElementById('edit-author_id').value = this.dataset.author_id;
            document.getElementById('edit-status').value = this.dataset.status;
        });
    });
</script>


@endsection
