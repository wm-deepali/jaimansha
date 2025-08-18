@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Brochures</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBrochureModal">+ Add Brochure</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <!--<th>#</th>-->
                    <th>Title</th>
                    <th>PDF</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brochures as $key => $brochure)
                <tr>
                    <!--<td>{{ $key + 1 }}</td>-->
                    <td>{{ $brochure->title }}</td>
                    <td>
                        @if($brochure->pdf_file)
                            <a href="{{ asset('public/'.$brochure->pdf_file) }}" target="_blank" class="btn btn-sm btn-info">View PDF</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $brochure->status == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $brochure->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $brochure->id }}"
                            data-title="{{ $brochure->title }}"
                            data-pdf="{{ $brochure->pdf_file }}"
                            data-status="{{ $brochure->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editBrochureModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.brochures.destroy', $brochure->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this brochure?')">
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
</div>

<!-- Add Brochure Modal -->
<div class="modal fade" id="addBrochureModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.brochures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Brochure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>PDF File</label>
                        <input type="file" name="pdf_file" class="form-control" accept="application/pdf" required>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Brochure Modal -->
<div class="modal fade" id="editBrochureModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editBrochureForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST') {{-- Method ko JS me change karenge --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Brochure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" id="edit-title" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Replace PDF (optional)</label>
                        <input type="file" name="pdf_file" class="form-control" accept="application/pdf">
                        <small id="current-pdf" class="text-muted"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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

<!-- JS for Edit Modal -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const form = document.getElementById('editBrochureForm');
            form.action = `/admin/brochures/update/${id}`;
            form.querySelector('input[name="_method"]').value = 'POST'; // route me post use hoga update ke liye

            document.getElementById('edit-title').value = this.dataset.title;
            document.getElementById('edit-status').value = this.dataset.status;

            const pdfLink = this.dataset.pdf ? `<a href="/${this.dataset.pdf}" target="_blank">View current PDF</a>` : 'No PDF uploaded';
            document.getElementById('current-pdf').innerHTML = pdfLink;
        });
    });
</script>
@endsection
