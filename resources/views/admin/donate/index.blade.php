@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <h4>Donate Page Content</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDonateModal">
            Add Donate Content
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Slug</th>
                    <!--<th>Meta Description</th>-->
                    <!--<th>Meta Keywords</th>-->
                    <th>Status</th>
                    <th style="min-width: 140px;">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($donates as $item)
                <tr>
                    <td>{{ $item->title ?? 'N/A' }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->description), 50) !!}</td>

                    <td>
                        @if($item->image)
                            <img src="{{ asset('public/uploads/donate/' . $item->image) }}" alt="Donate Image" width="80" height="50" style="object-fit: cover;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $item->slug ?: 'N/A' }}</td>
                    <!--<td>{{ $item->meta_description ?: 'N/A' }}</td>-->
                    <!--<td>{{ $item->meta_keywords ?: 'N/A' }}</td>-->
                    <td>
                        <span class="badge {{ $item->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($item->status) ?? 'N/A' }}
                        </span>
                    </td>
                    <td>
                        <button type="button"
                            class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $item->id }}"
                            data-title="{{ $item->title }}"
                            data-description="{{ $item->description }}"
                            data-meta_description="{{ $item->meta_description ?? '' }}"
                            data-meta_keywords="{{ $item->meta_keywords ?? '' }}"
                            data-slug="{{ $item->slug ?? '' }}"
                            data-status="{{ $item->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editDonateModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.donate.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No donate content found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addDonateModal" tabindex="-1" aria-labelledby="addDonateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.donate.store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDonateModalLabel">Add Donate Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="add-title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="add-description" class="form-label">Description</label>
                        <textarea name="description" id="add-description" class="form-control rich-editor" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="add-slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="add-slug" class="form-control rich-editor" required placeholder="Enter URL friendly slug">
                    </div>

                    <div class="mb-3">
                        <label for="add-meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" id="add-meta_description" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="add-meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="add-meta_keywords" class="form-control" placeholder="Comma separated keywords">
                    </div>

                    <div class="mb-3">
                        <label for="add-image" class="form-label">Image</label>
                        <input type="file" name="image" id="add-image" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="add-status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="add-status" class="form-select" required>
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editDonateModal" tabindex="-1" aria-labelledby="editDonateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editDonateForm" method="POST" action="" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editDonateModalLabel">Edit Donate Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit-title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Description</label>
                        <textarea name="description" id="edit-description" class="form-control rich-editor" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit-slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="edit-slug" class="form-control" required placeholder="Enter URL friendly slug">
                    </div>

                    <div class="mb-3">
                        <label for="edit-meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" id="edit-meta_description" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit-meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="edit-meta_keywords" class="form-control" placeholder="Comma separated keywords">
                    </div>

                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Image</label>
                        <input type="file" name="image" id="edit-image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep existing image</small>
                    </div>

                    <div class="mb-3">
                        <label for="edit-status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="edit-status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit button JS --}}
<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const description = this.dataset.description;
            const slug = this.dataset.slug;
            const meta_description = this.dataset.meta_description;
            const meta_keywords = this.dataset.meta_keywords;
            const status = this.dataset.status;

            // Set values in modal
            document.getElementById('edit-title').value = title || '';
           $('#edit-description').summernote('code', description || '');

            document.getElementById('edit-slug').value = slug || '';
            document.getElementById('edit-meta_description').value = meta_description || '';
            document.getElementById('edit-meta_keywords').value = meta_keywords || '';
            document.getElementById('edit-status').value = status || 'inactive';

            // Set form action URL dynamically
            document.getElementById('editDonateForm').action = `/admin/donate/update/${id}`;
        });
    });
</script>

@endsection
