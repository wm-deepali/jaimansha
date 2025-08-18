@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Introduction Features</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFeatureModal">
            Add Feature
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Intro</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($features as $feature)
                <tr>
                    <td>{{ $feature->introduction->heading ?? '-' }}</td>
                    <td>
                        @if($feature->icon && file_exists(public_path('uploads/icons/' . $feature->icon)))
                            <img src="{{ asset('uploads/icons/' . $feature->icon) }}" width="30" height="30">
                        @else
                            <i class="{{ $feature->icon }}"></i>
                        @endif
                    </td>
                    <td>{{ $feature->feature_title }}</td>
                    <td>{!! Str::limit(strip_tags($feature->feature_content), 80) !!}</td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $feature->id }}"
                            data-title="{{ $feature->feature_title }}"
                            data-content="{{ $feature->feature_content }}"
                            data-icon="{{ $feature->icon }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editFeatureModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.manageintroduction.feature.destroy', $feature->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this feature?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ➕ Add Feature Modal --}}
    <div class="modal fade" id="addFeatureModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.manageintroduction.feature.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Feature</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Introduction</label>
                            <select name="introduction_id" class="form-control" required>
                                @foreach(App\Models\Admin\ManageIntroduction\Introduction::all() as $intro)
                                    <option value="{{ $intro->id }}">{{ $intro->heading }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Icon (upload image)</label>
                            <input type="file" name="icon_file" class="form-control">
                            <small class="text-muted">Or leave blank to use icon class below.</small>
                        </div>

                        <div class="mb-3">
                            <label>Icon Class (e.g. fa fa-check)</label>
                            <input type="text" name="icon" class="form-control" placeholder="Optional">
                        </div>

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="feature_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="feature_content" class="form-control rich-editor" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ✏️ Edit Modal --}}
    <div class="modal fade" id="editFeatureModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="editFeatureForm" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Feature</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Icon (upload new to replace)</label>
                            <input type="file" name="icon_file" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Icon Class</label>
                            <input type="text" name="icon" id="edit-icon" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="feature_title" id="edit-title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Content</label>
                            <textarea name="feature_content" id="edit-content" class="form-control rich-editor" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ✅ JS: Fill Edit Modal --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const content = this.dataset.content;
            const icon = this.dataset.icon;

            document.getElementById('edit-title').value = title;
            document.getElementById('edit-content').value = content;
            document.getElementById('edit-icon').value = icon;

            const form = document.getElementById('editFeatureForm');
            form.action = `{{ url('admin/manageintroduction/feature') }}/${id}`;
        });
    });
</script>

<!-- {{-- ✅ TinyMCE OR CKEditor (Optional Rich Text) --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.rich-editor',
        height: 200,
        menubar: false
    });
</script> -->
@endsection
