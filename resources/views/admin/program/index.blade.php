@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Programs</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProgramModal">
        + Add Program
    </button>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Text 1</th>
                    <th>Text 2</th>
                    <th>Points</th>
                    <th>Video Image</th>
                    <th>Video URL</th>
                    <th>Text 3</th>
                    <th>Tabs</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Added Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $index => $program)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $program->title }}</td>
<td>{!!   $program->text_1 !!}</td>
<td>{!!  $program->text_2 !!}</td>

                    <td>
                        @php
                            $points = json_decode($program->points, true);
                            if (!is_array($points)) {
                                $points = explode(',', $program->points);
                            }
                        @endphp
                        <ul>
                            @foreach($points as $point)
                                <li>{{ is_array($point) ? implode(', ', $point) : $point }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if($program->video_image)
                            <img src="{{ asset('public/uploads/programs/' . $program->video_image) }}" width="60">
                        @endif
                    </td>
                    <td>
                        <a href="{{ $program->video_url }}" target="_blank">View</a>
                    </td>
                    <td>{!! $program->text_3 !!}</td>
                    <td>
                        @php
                            $tabs = json_decode($program->tabs, true);
                        @endphp
                        @if(is_array($tabs))
                            <ul>
                                @foreach($tabs as $tab)
                                    <li>
                                        <strong>{{ $tab['title'] ?? '' }}</strong>: {{ $tab['content'] ?? '' }}
                                        @if(!empty($tab['points']) && is_array($tab['points']))
                                            <ul>
                                                @foreach($tab['points'] as $p)
                                                    <li>{{ $p }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            {!! $program->tabs !!}
                        @endif
                    </td>
                    <td>{{ $program->slug }}</td>
                    <td>{{ ucfirst($program->status) }}</td>
                    <td>{{ $program->added_date }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn"
                            data-id="{{ $program->id }}"
                            data-title="{{ $program->title }}"
                            data-slug="{{ $program->slug }}"
                            data-text_1="{{ $program->text_1 }}"
                            data-text_2="{{ $program->text_2 }}"
                            data-points='@json($points)'
                            data-video_image="{{ $program->video_image }}"
                            data-video_url="{{ $program->video_url }}"
                            data-text_3="{{ $program->text_3 }}"
                            data-tabs='@json($tabs)'
                            data-status="{{ $program->status }}"
                            data-added_date="{{ $program->added_date }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.program.destroy', $program->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this program?')">
                            @csrf @method('POST')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addProgramModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.program.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label>Text 1</label>
                    <textarea name="text_1" class="form-control rich-editor" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label>Text 2</label>
                    <textarea name="text_2" class="form-control rich-editor" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label>Points (comma separated)</label>
                    <input type="text" name="points" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Video Image</label>
                    <input type="file" name="video_image" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Video URL</label>
                    <input type="text" name="video_url" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Text 3</label>
                    <textarea name="text_3" class="form-control rich-editor" rows="2"></textarea>
                </div>
                <div class="col-md-12">
                    <label>Tabs (JSON format)</label>
                    <textarea name="tabs" class="form-control rich-editor" rows="3" placeholder='[{"title":"Tab 1","content":"Content 1","points":["p1","p2"]}]'></textarea>
                </div>
                <div class="col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Added Date</label>
                    <input type="date" name="added_date" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Program</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" id="edit-title" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Slug</label>
                        <input type="text" name="slug" id="edit-slug" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Text 1</label>
                        <textarea name="text_1" id="edit-text_1" class="form-control rich-editor" rows="2"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Text 2</label>
                        <textarea name="text_2" id="edit-text_2" class="form-control rich-editor" rows="2"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Points (comma separated)</label>
                        <input type="text" name="points" id="edit-points" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Video Image</label>
                        <input type="file" name="video_image" class="form-control">
                        <img id="edit-video-image-preview" src="" width="100" class="mt-2" />
                    </div>
                    <div class="col-md-6">
                        <label>Video URL</label>
                        <input type="text" name="video_url" id="edit-video_url" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Text 3</label>
                        <textarea name="text_3" id="edit-text_3" class="form-control rich-editor" rows="2"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Tabs (JSON format)</label>
                        <textarea name="tabs" id="edit-tabs" class="form-control rich-editor" rows="3"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" id="edit-status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Added Date</label>
                        <input type="date" name="added_date" id="edit-added_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update Program</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('editForm').action = `/admin/program/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-title').value = this.dataset.title;
                document.getElementById('edit-slug').value = this.dataset.slug;
$('#edit-text_1').summernote('code', this.dataset.text_1 || '');
$('#edit-text_2').summernote('code', this.dataset.text_2 || '');


                document.getElementById('edit-points').value = JSON.parse(this.dataset.points).join(',');
                document.getElementById('edit-video_url').value = this.dataset.video_url;
              $('#edit-text_3').summernote('code', this.dataset.text_3 || '');

                document.getElementById('edit-tabs').value = JSON.stringify(JSON.parse(this.dataset.tabs), null, 2);
                document.getElementById('edit-status').value = this.dataset.status;
                document.getElementById('edit-added_date').value = this.dataset.added_date;
                document.getElementById('edit-video-image-preview').src = `/uploads/programs/${this.dataset.video_image}`;
            });
        });
    });
</script>
@endsection
