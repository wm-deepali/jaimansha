@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Introduction Management</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIntroModal">
            Add Introduction
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Heading</th>
                    <th>Detail Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($introductions as $intro)
                    <tr>
                        <td>{{ $intro->heading }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($intro->detail_content), 20) !!}</td>

                        <td>
                            <button class="btn btn-sm btn-primary editIntroBtn"
                                    data-id="{{ $intro->id }}"
                                    data-heading="{{ $intro->heading }}"
                                    data-detail="{{ $intro->detail_content }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editIntroModal">
                                Edit
                            </button>

                            <form action="{{ route('admin.manageintroduction.introduction.destroy', $intro->id) }}" method="POST" class="d-inline">
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

    <!-- Add Introduction Modal -->
    <div class="modal fade" id="addIntroModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.manageintroduction.introduction.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Introduction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Heading</label>
                            <input type="text" name="heading" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Detail</label>
                            <textarea name="detail_content" rows="4" class="form-control rich-editor"></textarea>
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

    <!-- Edit Introduction Modal -->
    <div class="modal fade" id="editIntroModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editIntroForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Introduction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Heading</label>
                            <input type="text" name="heading" id="edit-heading" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Detail Content</label>
                            <textarea name="detail_content" id="edit-detail" rows="4" class="form-control rich-editor"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.querySelectorAll('.editIntroBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const heading = this.dataset.heading;
            const detail = this.dataset.detail;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-heading').value = heading;
          $('#edit-detail').summernote('code', detail || '');


            const route = `{{ route('admin.manageintroduction.introduction.update', ['id' => '___id___']) }}`.replace('___id___', id);
            document.getElementById('editIntroForm').action = route;
        });
    });
</script>


@endsection
