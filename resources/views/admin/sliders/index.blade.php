@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Slider Management</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSliderModal">
            Add Slider
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Fixed Title</th>
                    <th>Fixed Color Title</th>
                    <th>Subtitle</th>
                    <th>Animation Text</th>
                    <th>Button Text</th>
                    <th>Video URL</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliders as $key => $slider)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->fixed_title }}</td>
                    <td>{{ $slider->fixed_color_title }}</td>
                    <td>{{ $slider->subtitle }}</td>
                    <td>{!! $slider->animation_text !!}</td>
                    <td>{{ $slider->button_text }}</td>
                    <td>{{ $slider->video_url }}</td>
                    <td>
                        @if($slider->image)
                            <img src="{{ asset('public/adminpannel/uploads/sliders/' . $slider->image) }}" width="80">
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $slider->status == 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($slider->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info editBtn"
                            data-id="{{ $slider->id }}"
                            data-title="{{ $slider->title }}"
                            data-fixed_title="{{ $slider->fixed_title }}"
                            data-fixed_color_title="{{ $slider->fixed_color_title }}"
                            data-subtitle="{{ $slider->subtitle }}"
                            data-animation_text="{{ htmlentities($slider->animation_text) }}"
                            data-button_text="{{ $slider->button_text }}"
                            data-video_url="{{ $slider->video_url }}"
                            data-image="{{ $slider->image }}"
                            data-status="{{ $slider->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editSliderModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
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

    {{-- Add Slider Modal --}}
    <div class="modal fade" id="addSliderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">

                        <div class="col-md-6">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Fixed Title</label>
                            <input type="text" name="fixed_title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Fixed Color Title</label>
                            <input type="text" name="fixed_color_title" class="form-control" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Animation Text</label>
                            <textarea name="animation_text" class="form-control rich-editor" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Button Text</label>
                            <input type="text" name="button_text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Video URL</label>
                            <input type="file" name="video_url" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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

    {{-- Edit Slider Modal --}}
    <div class="modal fade" id="editSliderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="editSliderForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">

                        <div class="col-md-6">
                            <label>Title</label>
                            <input type="text" name="title" id="edit-title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Fixed Title</label>
                            <input type="text" name="fixed_title" id="edit-fixed_title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Fixed Color Title</label>
                            <input type="text" name="fixed_color_title" id="edit-fixed_color_title" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" id="edit-subtitle" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Animation Text</label>
                            <textarea name="animation_text" id="edit-animation_text" class="form-control rich-editor" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Button Text</label>
                            <input type="text" name="button_text" id="edit-button_text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Video URL</label>
                            <input type="file" name="video_url" id="edit-video_url" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                            <div id="edit-image-preview" class="mt-2"></div>
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" id="edit-status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                const d = this.dataset;

                // Form fields fill
                document.getElementById('edit-id').value = d.id;
                document.getElementById('edit-title').value = d.title;
                document.getElementById('edit-fixed_title').value = d.fixed_title;
                document.getElementById('edit-fixed_color_title').value = d.fixed_color_title;
                document.getElementById('edit-subtitle').value = d.subtitle;
                $('#edit-animation_text').summernote('code', d.animation_text);

                document.getElementById('edit-button_text').value = d.button_text;
                document.getElementById('edit-status').value = d.status;

                // ✅ Safe: Set form action dynamically
                document.getElementById('editSliderForm').action = `/admin/sliders/${d.id}`;

                // Optional image preview
                document.getElementById('edit-image-preview').innerHTML = d.image
                    ? `<img src="public/adminpannel/uploads/sliders/${d.image}" class="img-thumbnail" width="120">`
                    : '';
            });
        });
    });
</script>

</div>
@endsection
