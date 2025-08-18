@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Scholarship Content Management</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentModal">
            + Add Content
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title 1</th>
                <th>Title 2</th>
                <th>Title 3</th>
                <th>Short Description 1</th>
                <th>Short Description 2</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contents as $content)
            <tr>
                <td>{{ $content->title_1 }}</td>
                <td>{{ $content->title_2 }}</td>
                <td>{{ $content->title_3 }}</td>
               <td>{!! \Illuminate\Support\Str::limit(strip_tags($content->short_description_1), 50) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($content->short_description_2), 50) !!}</td>

                
                <td>
                    <button class="btn btn-sm btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#editContentModal"
                        data-id="{{ $content->id }}"
                        data-title_1="{{ $content->title_1 }}"
                        data-title_2="{{ $content->title_2 }}"
                        data-title_3="{{ $content->title_3 }}"
                        data-short_description_1="{{ $content->short_description_1 }}"
                        data-short_description_2="{{ $content->short_description_2 }}"
                        onclick="setEditContentData(this)">
                        Edit
                    </button>

                    <form action="{{ route('admin.scholarship_content.delete', $content->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.scholarship_content.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Scholarship Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-4 mb-3">
                        <label>Title 1</label>
                        <input type="text" name="title_1" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Title 2</label>
                        <input type="text" name="title_2" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Title 3</label>
                        <input type="text" name="title_3" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Short Description 1</label>
                        <textarea name="short_description_1" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Short Description 2</label>
                        <textarea name="short_description_2" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Content</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editContentForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Scholarship Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-4 mb-3">
                        <label>Title 1</label>
                        <input type="text" id="edit_title_1" name="title_1" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Title 2</label>
                        <input type="text" id="edit_title_2" name="title_2" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Title 3</label>
                        <input type="text" id="edit_title_3" name="title_3" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Short Description 1</label>
                        <textarea id="edit_short_description_1" name="short_description_1" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Short Description 2</label>
                        <textarea id="edit_short_description_2" name="short_description_2" class="form-control rich-editor" rows="3" required></textarea>
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

<script>
function setEditContentData(button) {
    document.getElementById('edit_title_1').value = button.getAttribute('data-title_1');
    document.getElementById('edit_title_2').value = button.getAttribute('data-title_2');
    document.getElementById('edit_title_3').value = button.getAttribute('data-title_3');
  $('#edit_short_description_1').summernote('code', button.getAttribute('data-short_description_1') || '');
$('#edit_short_description_2').summernote('code', button.getAttribute('data-short_description_2') || '');


    const form = document.getElementById('editContentForm');
    const id = button.getAttribute('data-id');
    form.action = `/admin/scholarship-content/update/${id}`;
}
</script>
@endsection
