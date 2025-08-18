@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Gallery Media</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMediaModal">+ Add Media</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Media Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Preview</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($media as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->title ?? '-' }}</td>
                    <td>
                        @if($item->media_type === 'image')
                            <img src="{{ asset('public/'.$item->file_path) }}" width="80" height="60" alt="img">
                        @else
                            <video src="{{ asset('public/'.$item->file_path) }}" width="100" height="60" controls></video>
                        @endif
                    </td>
                    <td>{{ ucfirst($item->media_type) }}</td>
                    <td>{{ $item->category->category_name ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.gallery.media.status', $item->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $item->status === 'active' ? 'btn-success' : 'btn-secondary' }}">
                                {{ ucfirst($item->status) }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm editMediaBtn"
                            data-id="{{ $item->id }}"
                            data-title="{{ $item->title }}"
                            data-media_type="{{ $item->media_type }}"
                            data-category_id="{{ $item->category_id }}"
                            data-bs-toggle="modal" data-bs-target="#editMediaModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.gallery.media.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this media?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addMediaModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.gallery.media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>File</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Media Type</label>
                        <select name="media_type" class="form-control" required>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editMediaModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editMediaForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="edit-title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Replace File (optional)</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Media Type</label>
                        <select name="media_type" id="edit-media_type" class="form-control" required>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" id="edit-category_id" class="form-control" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JS for Edit Modal Population -->
<script>
    document.querySelectorAll('.editMediaBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editMediaForm');
            form.action = `/admin/gallery/media/update/${id}`;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = this.dataset.title;
            document.getElementById('edit-media_type').value = this.dataset.media_type;
            document.getElementById('edit-category_id').value = this.dataset.category_id;
        });
    });
</script>
@endsection
