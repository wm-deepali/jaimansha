@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Awards & Certifications</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAwardModal">
            Add Award
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Heading 1</th>
                    <th>Heading 2</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($awards as $award)
                <tr>
                    <td>{{ $award->heading_1 }}</td>
                    <td>{{ $award->heading_2 }}</td>
                    <td>{{ $award->title }}</td>
                    <td>{!! \Illuminate\Support\Str::limit($award->description) !!}</td>
                    <td>
                        @if($award->image)
                            @php $ext = pathinfo($award->image, PATHINFO_EXTENSION); @endphp
                            @if($ext === 'pdf')
                                <a href="{{ asset('public/uploads/awards/pdfs/' . $award->image) }}" target="_blank" class="btn btn-warning btn-sm">
                                    View PDF
                                </a>
                            @else
                                <img src="{{ asset('public/uploads/awards/' . $award->image) }}" alt="File {{ $award->title }}" width="80">
                            @endif
                        @else
                            <span class="text-muted">No File</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $award->id }}"
                            data-heading_1="{{ $award->heading_1 }}"
                            data-heading_2="{{ $award->heading_2 }}"
                            data-title="{{ $award->title }}"
                            data-description="{{ $award->description }}"
                            data-image="{{ $award->image }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editAwardModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.awards.destroy', $award->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this award?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
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
    <div class="modal fade" id="addAwardModal" tabindex="-1" aria-labelledby="addAwardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.awards.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Award</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Heading 1</label>
                            <input type="text" name="heading_1" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Heading 2</label>
                            <input type="text" name="heading_2" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea name="description" class="form-control rich-editor" rows="4"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label>Upload Image / PDF</label>
                            <input type="file" name="image" class="form-control" accept="image/*,application/pdf">
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
    <div class="modal fade" id="editAwardModal" tabindex="-1" aria-labelledby="editAwardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editAwardForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Award</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Heading 1</label>
                            <input type="text" name="heading_1" id="edit-heading_1" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Heading 2</label>
                            <input type="text" name="heading_2" id="edit-heading_2" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea name="description" id="edit-description" class="form-control rich-editor" rows="4"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label>Upload Image / PDF (Leave blank to keep current)</label>
                            <input type="file" name="image" class="form-control" accept="image/*,application/pdf">
                            <div class="mt-2" id="current-file-display">
                                <img id="current-image" src="" alt="Current File" width="100" style="display:none;">
                                <a id="current-pdf" href="#" target="_blank" class="btn btn-warning btn-sm" style="display:none;">View PDF</a>
                            </div>
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
</div>

{{-- JS --}}
<script>
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const heading1 = this.dataset.heading_1;
        const heading2 = this.dataset.heading_2;
        const title = this.dataset.title;
        const description = this.dataset.description;
        const image = this.dataset.image;

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-heading_1').value = heading1;
        document.getElementById('edit-heading_2').value = heading2;
        document.getElementById('edit-title').value = title;
        document.getElementById('edit-description').value = description;

        const imgEl = document.getElementById('current-image');
        const pdfEl = document.getElementById('current-pdf');

        if(image){
            const ext = image.split('.').pop().toLowerCase();
            if(ext === 'pdf'){
                imgEl.style.display = 'none';
                pdfEl.href = `{{ asset('public/uploads/awards') }}/${image}`;
                pdfEl.style.display = 'inline-block';
            } else {
                imgEl.src = `{{ asset('public/uploads/awards') }}/${image}`;
                imgEl.style.display = 'block';
                pdfEl.style.display = 'none';
            }
        } else {
            imgEl.style.display = 'none';
            pdfEl.style.display = 'none';
        }

        document.getElementById('editAwardForm').action = `/admin/awards/update/${id}`;
    });
});
</script>
@endsection


