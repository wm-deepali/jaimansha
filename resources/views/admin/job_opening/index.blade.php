@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Jobs Management</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobsModal">
                Add Jobs
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Job Title</th>
                        <th>Job Qualification</th>
                        <th>Job Location</th>
                        <th>No of Candidates</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $item)
                        <tr>
                            <td>

                                {{ $item->job_title }}

                            </td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($item->qualification ?? 'N/A') }}</span>
                            </td>
                            <td>
                                {{ $item->job_location }}
                            </td>
                            <td>
                                {{ $item->num_candidates }}
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary editBtn" data-id="{{ $item->id }}"
                                    data-job_title="{{ $item->job_title }}" data-qualification="{{ $item->qualification }}"
                                    data-job_location="{{ $item->job_location }}"
                                    data-num_candidates="{{ $item->num_candidates }}" data-bs-toggle="modal"
                                    data-bs-target="#editJobsModal">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <form action="{{ route('admin.jobs.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure to delete this jobs?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Add Modal --}}
        <div class="modal fade" id="addJobsModal" tabindex="-1" aria-labelledby="addJobsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('admin.jobs.store') }}" enctype="multipart/form-data" id="addJobsForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Jobs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="job_title" id="add_job_title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Qualification</label>
                                <input type="text" name="qualification" id="add_qualification" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" name="job_location" id="add_job_location" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No. of Candidates</label>
                                <input type="number" name="num_candidates" id="add_num_candidates" class="form-control"
                                    required min="1">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Jobs</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div class="modal fade" id="editJobsModal" tabindex="-1" aria-labelledby="editJobsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="" enctype="multipart/form-data" id="editJobsForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Jobs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="job_title" id="edit_job_title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Qualification</label>
                                <input type="text" name="qualification" id="edit_qualification" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" name="job_location" id="edit_job_location" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No. of Candidates</label>
                                <input type="number" name="num_candidates" id="edit_num_candidates" class="form-control"
                                    required min="1">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Jobs</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Scripts for showing/hiding fields based on jobs type --}}
    <script>

        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                const data = this.dataset;

                // Set basic fields (use exact IDs)
                document.getElementById('edit_id').value = data.id || '';
                document.getElementById('edit_job_title').value = data.job_title || '';
                document.getElementById('edit_qualification').value = data.qualification || '';
                document.getElementById('edit_job_location').value = data.job_location || '';
                document.getElementById('edit_num_candidates').value = data.num_candidates || '';

                // Set form action dynamically
                document.getElementById('editJobsForm').action = `/admin/jobs/update/${data.id}`;
            });
        });




        // Reset Add modal when it's closed
        document.getElementById('addJobsModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('addJobsForm').reset();
        });


    </script>

    <style>
        /* Custom styling for better UI */
        .table th {
            background-color: #495057 !important;
            color: white !important;
            font-weight: 600;
        }

        .badge {
            font-size: 0.8em;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .alert-info {
            background-color: #e3f2fd;
            border-color: #bbdefb;
            color: #1976d2;
        }

        .btn-sm {
            margin-right: 5px;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.9em;
            }

            .modal-dialog {
                margin: 10px;
            }
        }
    </style>

@endsection