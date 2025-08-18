@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Legal Documents</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLegalModal">+ Add Legal</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Short Info</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $doc)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $doc->title }}</td>
                    <td>{!! $doc->short_info !!}</td>
                    <td>
                        @if($doc->image)
                            <img src="{{ asset('public/uploads/legal/' . $doc->image) }}" width="60">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($doc->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editLegal({{ $doc->id }})" data-bs-toggle="modal" data-bs-target="#editLegalModal">Edit</button>
                        <form method="POST" action="{{ route('admin.legal.destroy', $doc->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this document?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($documents->isEmpty())
                    <tr><td colspan="6" class="text-center text-muted">No legal documents found.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addLegalModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.legal.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Legal Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Title</label>
                    <input name="title" type="text" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Short Info</label>
                    <textarea name="short_info" class="form-control rich-editor" required></textarea>
                </div>
                <div class="mb-2">
                    <label>Image</label>
                    <input name="image" type="file" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editLegalModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" class="modal-content" id="editLegalForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Legal Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Title</label>
                    <input name="title" type="text" id="editTitle" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Short Info</label>
                    <textarea name="short_info" id="editShortInfo" class="form-control rich-editor" required></textarea>
                </div>
                <div class="mb-2">
                    <label>Image</label>
                    <input name="image" type="file" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Status</label>
                    <select name="status" class="form-control" id="editStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    $('#addLegalModal').on('shown.bs.modal', function () {
        $('#addLegalModal .summernote').summernote({
            height: 150
        });
    });

    $('#editLegalModal').on('shown.bs.modal', function () {
        $('#editLegalModal .summernote').summernote({
            height: 150
        });
    });
});


    function editLegal(id) {
        fetch(`/admin/legal/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editTitle').value = data.title;
                $('#editShortInfo').summernote('code', data.short_info);
                document.getElementById('editStatus').value = data.status;
                document.getElementById('editLegalForm').action = `/admin/legal/${id}`;
            });
    }
</script>
@endsection
