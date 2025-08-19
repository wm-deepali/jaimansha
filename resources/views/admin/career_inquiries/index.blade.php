@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Career Inquires</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date & Time</th>
                        <th>Post Applied</th>
                        <th>Full Name</th>
                        <th>Email Id</th>
                        <th>Mobile Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applied_jobs as $item)
                        <tr>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                {{ $item->applied_post }}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                {{ $item->mobile }}
                            </td>
                            <td>
                                {{ $item->status ?? 'Active' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.career_inquiries.show', $item->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>


                                <form action="{{ route('admin.career_inquiries.destroy', $item->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Are you sure to delete this jobs?')">
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


    </div>


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