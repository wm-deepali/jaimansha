@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Publications</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPublicationModal">+ Add Publication</button>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <!--<th>#</th>-->
                    <th>Author</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Registered By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
       @forelse($publications as $index => $pub)
    @php
        $authorType = $pub->author->author_type;
    @endphp

    @if($authorType === 'publication' || $authorType === 'both')
        <tr>
            <!--<td>{{ $index + 1 }}</td>-->
            <td>{{ $pub->author->name ?? 'N/A' }}</td>
<td>{{ \Illuminate\Support\Str::limit($pub->title, 20) }}</td>
            <td>{!! \Illuminate\Support\Str::limit(strip_tags($pub->short_description), 50) !!}</td>

            <td>{{ ucfirst($pub->registered_by) }}</td>
            <td>
                @if($pub->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <button class="btn btn-primary btn-sm editBtn"
                    data-id="{{ $pub->id }}"
                    data-title="{{ $pub->title }}"
                    data-description="{{ $pub->short_description }}"
                    data-author_id="{{ $pub->author_id }}"
                    data-registered_by="{{ $pub->registered_by }}"
                    data-status="{{ $pub->status }}"
                    data-bs-toggle="modal" data-bs-target="#editPublicationModal">
                    Edit
                </button>
                <form action="{{ route('admin.emagazine.publication.destroy', $pub->id) }}" method="POST" class="d-inline">
                    @csrf @method('POST')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                </form>
            </td>
        </tr>
    @endif
@empty
    <tr><td colspan="7" class="text-center">No Publications Found.</td></tr>
@endforelse

            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addPublicationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.publications.authors.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Add Publication</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2">
                <label>Author</label>
                <select name="author_id" class="form-control" required>
                    <option value="">Select Author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->author_type }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required />
            </div>
            <div class="mb-2">
                <label>Description</label>
                <textarea name="short_description" class="form-control rich-editor" rows="3"></textarea>
            </div>
            <div class="mb-2">
                <label>Registered By</label>
                <select name="registered_by" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="online">Online</option>
                </select>
            </div>
            <div class="mb-2">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success">Submit</button>
        </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPublicationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" method="POST" class="modal-content">
        @csrf @method('POST')
        <input type="hidden" name="id" id="edit-id" />
        <div class="modal-header">
            <h5 class="modal-title">Edit Publication</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2">
                <label>Author</label>
                <select name="author_id" class="form-control" id="edit-author_id" required>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->author_type }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label>Title</label>
                <input type="text" name="title" id="edit-title" class="form-control" required />
            </div>
            <div class="mb-2">
                <label>Description</label>
                <textarea name="short_description" id="edit-description" class="form-control rich-editor" rows="3"></textarea>
            </div>
            <div class="mb-2">
                <label>Registered By</label>
                <select name="registered_by" id="edit-registered_by" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="online">Online</option>
                </select>
            </div>
            <div class="mb-2">
                <label>Status</label>
                <select name="status" id="edit-status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
  </div>
</div>

<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const description = this.dataset.description;
            const author_id = this.dataset.author_id;
            const registered_by = this.dataset.registered_by;
            const status = this.dataset.status;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            $('#edit-description').summernote('code', description || '');

            document.getElementById('edit-author_id').value = author_id;
            document.getElementById('edit-registered_by').value = registered_by;
            document.getElementById('edit-status').value = status;

            document.getElementById('editForm').action = `/admin/publications/author/update/${id}`;
        });
    });
</script>
@endsection
