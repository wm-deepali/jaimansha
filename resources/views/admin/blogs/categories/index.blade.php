@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Blog Categories</h4>
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
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Meta Title</th>
                    <th>Image</th>
                    <th>Meta Keywords</th>
                    <th>Written By</th>
                    <th>Meta Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->meta_title }}</td>
                    <td>
         @if($category->image)
    <img src="{{ asset('public/' . $category->image) }}" width="60" height="60" style="object-fit: cover;">
@else
    <span class="text-muted">No image</span>
@endif


                    </td>
                    <td>{!! $category->meta_keywords !!}</td>
                    <td>{{ $category->written_by ?? '-' }}</td>
                    <td>{!! $category->meta_description !!}</td>
                    <td>
                        <span class="badge {{ $category->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $category->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->category_name }}"
                            data-slug="{{ $category->slug }}"
                            data-meta_title="{{ $category->meta_title }}"
                            data-meta_keywords="{{ $category->meta_keywords }}"
                            data-written_by="{{ $category->written_by }}"
                            data-meta_description="{{ $category->meta_description }}"
                            data-status="{{ $category->status }}"
                            data-image="{{ $category->image }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editCategoryModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.blogs.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
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
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.blogs.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>Category Name</label><input type="text" name="category_name" class="form-control" required></div>
                    <div class="col-md-6"><label>Slug</label><input type="text" name="slug" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Title</label><input type="text" name="meta_title" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Keywords</label><input type="text" name="meta_keywords" class="form-control"></div>
                    <div class="col-md-6">
    <label>Written By</label>
    <input type="text" name="written_by" class="form-control">
</div>

                    <div class="col-md-12"><label>Meta Description</label><input type="text" name="meta_description" class="form-control"></div>
                    <div class="col-md-6"><label>Status</label><br>
                        <select name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Category Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>Category Name</label><input type="text" name="category_name" id="edit-name" class="form-control"></div>
                    <div class="col-md-6"><label>Slug</label><input type="text" name="slug" id="edit-slug" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Title</label><input type="text" name="meta_title" id="edit-meta_title" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Keywords</label><input type="text" name="meta_keywords" id="edit-meta_keywords" class="form-control"></div>
                    <div class="col-md-6">
    <label>Written By</label>
    <input type="text" name="written_by" id="edit-written_by" class="form-control">
</div>

                    <div class="col-md-12"><label>Meta Description</label><input type="text" name="meta_description" id="edit-meta_description" class="form-control"></div>
                    <div class="col-md-6"><label>Status</label><br>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Category Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="mt-2">
                            <img id="current-image" src="" width="80" height="80" style="object-fit: cover;" />
                        </div>
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

<!-- JS to populate Edit Modal -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editCategoryForm');
            form.action = `/admin/blogs/categories/update/${id}`;

            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-slug').value = this.dataset.slug;
            document.getElementById('edit-meta_title').value = this.dataset.meta_title;
            document.getElementById('edit-meta_keywords').value = this.dataset.meta_keywords;
            document.getElementById('edit-written_by').value = this.dataset.written_by || '';
            document.getElementById('edit-meta_description').value = this.dataset.meta_description;
            document.getElementById('edit-status').value = this.dataset.status;

            const imagePath = this.dataset.image;
            const imgTag = document.getElementById('current-image');
            if (imagePath) {
                imgTag.src = `/storage/${imagePath}`;
                imgTag.style.display = 'block';
            } else {
                imgTag.style.display = 'none';
            }
        });
    });
</script>
@endsection
