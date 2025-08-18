@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Vision & Mission</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVisionModal">
            Add Entry
        </button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="max-height: 500px;">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Vission</th>
                    <th>Mission</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($vision as $item)
                    <tr>
                      <td>{!! \Illuminate\Support\Str::limit(strip_tags($item->heading), 50) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($item->description), 50) !!}</td>
                        <td>
                            @if($item->image && file_exists(public_path('public/uploads/vision/' . $item->image)))
                                <img src="{{ asset('public/uploads/vision/' . $item->image) }}" width="60">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ ucfirst($item->status) }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary editBtn"
                                data-id="{{ $item->id }}"
                                data-heading="{{ $item->heading }}"
                                data-description="{{ $item->description }}"
                                data-status="{{ $item->status }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editVisionModal">Edit</button>

                            <form action="{{ route('admin.vision.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this entry?')">
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
    <div class="modal fade" id="addVisionModal" tabindex="-1" aria-labelledby="addVisionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.vision.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Vision/Mission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                       <div class="col-12">
    <label>Vission</label>
    <textarea name="heading" class="form-control rich-editor" rows="3" required></textarea>
</div>

                        <div class="col-12">
                            <label>Mission</label>
                            <textarea name="description" class="form-control rich-editor" rows="4" required></textarea>
                        </div>
                        <div class="col-12">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-12">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editVisionModal" tabindex="-1" aria-labelledby="editVisionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editVisionForm" method="POST" action="" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Vision/Mission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-12">
    <label>Vission</label>
    <textarea name="heading" id="edit-heading" class="form-control rich-editor" rows="3" required></textarea>
</div>

                        <div class="col-12">
                            <label>Mission</label>
                            <textarea name="description" id="edit-description" class="form-control rich-editor" rows="4" required></textarea>
                        </div>
                        <div class="col-12">
                            <label>Image (optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-12">
                            <label>Status</label>
                            <select name="status" id="edit-status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS to Fill Edit Modal --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            document.getElementById('editVisionForm').action = `/admin/vision/${id}`;
              $('#edit-heading').summernote('code', $(this).data('heading'));
    $('#edit-description').summernote('code', $(this).data('description'));
            document.getElementById('edit-status').value = this.dataset.status;
        });
    });
</script>
@endsection
