@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Co-Scholastics</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCoModal">
            Add Co-Scholastic
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($scholastics as $item)
                <tr>
                    <td>{{ $item->title }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->content), 50) !!}</td>

                    <td>
                        <span class="badge {{ $item->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $item->id }}"
                            data-title="{{ $item->title }}"
                            data-content="{{ $item->content }}"
                            data-status="{{ $item->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editCoModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.co_scholastics.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">
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
    <div class="modal fade" id="addCoModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.co_scholastics.store') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Co-Scholastic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label>Content</label>
                        <textarea name="content" class="form-control rich-editor" required></textarea>
                    </div>

                    <div class="col-md-12">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editCoModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editCoForm" method="POST" action="" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Co-Scholastic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label>Title</label>
                        <input type="text" name="title" id="edit-title" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label>Content</label>
                        <textarea name="content" id="edit-content" class="form-control rich-editor" required></textarea>
                    </div>

                    <div class="col-md-12">
                        <label>Status</label>
                        <select name="status" id="edit-status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const content = this.dataset.content;
            const status = this.dataset.status;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            $('#edit-content').summernote('code', content);

            document.getElementById('edit-status').value = status;

            document.getElementById('editCoForm').action = `/admin/co_scholastics/${id}`;
        });
    });
</script>
@endsection
