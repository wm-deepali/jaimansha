@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Legal & Reports</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCertModal">
            Add Certification
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
                    <th>Type</th>
                    <th>PDF</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($certifications as $cert)
                <tr>
                    <td>{{ $cert->title }}</td>
                    <td><span class="badge bg-info text-dark">{{ ucwords(str_replace('_', ' ', $cert->type)) }}</span></td>
                    <td>
                        @if($cert->pdf)
                            <a href="{{ asset('storage/' . $cert->pdf) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            <span class="text-muted">No PDF</span>
                        @endif
                    </td>
                    <td>{{ $cert->year ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $cert->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($cert->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $cert->id }}"
                            data-title="{{ $cert->title }}"
                            data-status="{{ $cert->status }}"
                            data-year="{{ $cert->year }}"
                            data-type="{{ $cert->type }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editCertModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.certifications.destroy', $cert->id) }}" method="POST" class="d-inline">
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
    <div class="modal fade" id="addCertModal" tabindex="-1" aria-labelledby="addCertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.certifications.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Certification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Type</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="annual_reports">Annual Reports</option>
                                <option value="management_committee">Management Committee</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label>PDF Upload</label>
                            <input type="file" name="pdf" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Year</label>
                            <select name="year" class="form-select" required>
                                <option value="">Select Year</option>
                                @for ($year = now()->year; $year <= now()->year + 5; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label>Status</label>
                            <select name="status" class="form-select">
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
    <div class="modal fade" id="editCertModal" tabindex="-1" aria-labelledby="editCertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCertForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Certification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Type</label>
                            <select name="type" id="edit-type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="annual_reports">Annual Reports</option>
                                <option value="management_committee">Management Committee</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label>Upload PDF</label>
                            <input type="file" name="pdf" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label>Year</label>
                            <select name="year" id="edit-year" class="form-select" required>
                                <option value="">Select Year</option>
                                @for ($year = now()->year; $year <= now()->year + 5; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-12">
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
</div>

{{-- JS --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const status = this.dataset.status;
            const year = this.dataset.year;
            const type = this.dataset.type;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-status').value = status;

            const yearSelect = document.getElementById('edit-year');
            [...yearSelect.options].forEach(option => {
                option.selected = option.value === year;
            });

            const typeSelect = document.getElementById('edit-type');
            [...typeSelect.options].forEach(option => {
                option.selected = option.value === type;
            });

            document.getElementById('editCertForm').action = `/admin/certifications/update/${id}`;
        });
    });
</script>
@endsection
