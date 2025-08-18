@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Blog Contents</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBlogModal">+ Add Blog</button>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Short Desc</th>
                    <th>Detail Desc</th>
                    <th>Banner</th>
                    <th>Thumbnail</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $key => $blog)
                <tr>
                    <td>{{ $key + 1 }}</td>
<td>{{ $blog->title }}</td>
<td>{{ $blog->slug }}</td>

                    <td>{{ $blog->category->category_name ?? 'N/A' }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($blog->short_description), 20) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($blog->detail_content), 20) !!}</td>

                    <td>
                        @if($blog->banner_image)
                        <img src="{{ asset('public/' . $blog->banner_image) }}" width="60">
                        @endif
                    </td>
                    <td>
                        @if($blog->thumbnail_image)
                        <img src="{{ asset('public/' . $blog->thumbnail_image) }}" width="60">
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $blog->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $blog->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $blog->id }}"
                            data-title="{{ $blog->title }}"
                            data-slug="{{ $blog->slug }}"
                            data-category_id="{{ $blog->category_id }}"
                            data-meta_title="{{ $blog->meta_title }}"
                            data-meta_keywords="{{ $blog->meta_keywords }}"
                            data-meta_description="{{ $blog->meta_description }}"
                            data-short_description="{{ $blog->short_description }}"
                            data-detail_content="{{ $blog->detail_content }}"
                            data-status="{{ $blog->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editBlogModal">Edit</button>

                        <form action="{{ route('admin.blogs.contents.delete', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this blog?')">
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

<!-- Add Blog Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.blogs.contents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>Title</label><input type="text" name="title" class="form-control" required></div>
                    <div class="col-md-6"><label>Slug</label><input type="text" name="slug" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Meta Title</label><input type="text" name="meta_title" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Keywords</label><input type="text" name="meta_keywords" class="form-control"></div>
                    <div class="col-md-12"><label>Meta Description</label><input type="text" name="meta_description" class="form-control"></div>
                    <div class="col-md-12"><label>Short Description</label><textarea name="short_description" class="form-control rich-editor" rows="2"></textarea></div>
                    <div class="col-md-12"><label>Detail Description</label><textarea name="detail_content" class="form-control rich-editor" rows="4"></textarea></div>
                    <div class="col-md-6"><label>Banner Image</label><input type="file" name="banner_image" class="form-control"></div>
                    <div class="col-md-6"><label>Thumbnail Image</label><input type="file" name="thumbnail_image" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
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

<!-- Edit Blog Modal -->
<div class="modal fade" id="editBlogModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editBlogForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="col-md-6"><label>Title</label><input type="text" name="title" id="edit-title" class="form-control"></div>
                    <div class="col-md-6"><label>Slug</label><input type="text" name="slug" id="edit-slug" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" id="edit-category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Meta Title</label><input type="text" name="meta_title" id="edit-meta_title" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Keywords</label><input type="text" name="meta_keywords" id="edit-meta_keywords" class="form-control"></div>
                    <div class="col-md-12"><label>Meta Description</label><input type="text" name="meta_description" id="edit-meta_description" class="form-control"></div>
                    <div class="col-md-12"><label>Short Description</label><textarea name="short_description" id="edit-short_description" class="form-control rich-editor" rows="2"></textarea></div>
                    <div class="col-md-12"><label>Detail Description</label><textarea name="detail_content" id="edit-detail_content" class="form-control rich-editor" rows="4"></textarea></div>
                    <div class="col-md-6"><label>Banner Image</label><input type="file" name="banner_image" class="form-control"></div>
                    <div class="col-md-6"><label>Thumbnail Image</label><input type="file" name="thumbnail_image" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
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

<!-- JS to populate Edit Modal -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = document.getElementById('editBlogForm');
            const id = this.dataset.id;
            form.action = `/admin/blogs/contents/update/${id}`;

            document.getElementById('edit-title').value = this.dataset.title;
            document.getElementById('edit-slug').value = this.dataset.slug;
            document.getElementById('edit-category_id').value = this.dataset.category_id;
            document.getElementById('edit-meta_title').value = this.dataset.meta_title;
            document.getElementById('edit-meta_keywords').value = this.dataset.meta_keywords;
            document.getElementById('edit-meta_description').value = this.dataset.meta_description;
$('#edit-short_description').summernote('code', this.dataset.short_description || '');
$('#edit-detail_content').summernote('code', this.dataset.detail_content || '');

            document.getElementById('edit-status').value = this.dataset.status;
        });
    });
</script>
@endsection
