@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Marquees Management</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMarqueesModal">
                Add Marquees
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date & Time</th>
                        <th>Message</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marquees as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{!! $item->message !!}</td>
                            <td>{{ $item->link ?? 'N/A' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary editBtn" data-id="{{ $item->id }}"
                                    data-message="{{ htmlspecialchars($item->message, ENT_QUOTES) }}"
                                    data-link="{{ $item->link }}" data-bs-toggle="modal" data-bs-target="#editMarqueesModal">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <form action="{{ route('admin.marquees.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure to delete this marquee?')">
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
        <div class="modal fade" id="addMarqueesModal" tabindex="-1" aria-labelledby="addMarqueesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('admin.marquees.store') }}" enctype="multipart/form-data"
                    id="addMarqueesForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Marquees</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" id="add_message" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link (optional)</label>
                                <input type="url" name="link" id="add_link" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Marquees</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div class="modal fade" id="editMarqueesModal" tabindex="-1" aria-labelledby="editMarqueesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="" enctype="multipart/form-data" id="editMarqueesForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Marquees</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit_id">

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" id="edit_message" class="form-control" rows="3"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link (optional)</label>
                                <input type="url" name="link" id="edit_link" class="form-control"
                                    placeholder="https://example.com">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Marquees</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Scripts for showing/hiding fields based on marquee type --}}
    <script>

        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                const data = this.dataset;

                document.getElementById('edit_id').value = data.id || '';
                document.getElementById('edit_message').value = data.message || '';
                document.getElementById('edit_link').value = data.link || '';

                document.getElementById('editMarqueesForm').action = `/admin/marquees/update/${data.id}`;
            });
        });





        // Reset Add modal when it's closed
        document.getElementById('addMarqueesModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('addMarqueesForm').reset();
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