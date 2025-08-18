@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Objectives</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addObjectiveModal">
            Add Objective
        </button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Objective</th>
                <!--<th>Created At</th>-->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objectives as $index => $objective)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{!! $objective->objective !!}</td>
                    <!--<td>{{ $objective->created_at }}</td>-->
                    <td class="d-flex gap-2">
                        <button class="btn btn-sm btn-info editBtn"
                            data-id="{{ $objective->id }}"
                            data-objective="{{ $objective->objective }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editObjectiveModal">Edit</button>

                        <form action="{{ route('admin.objectives.destroy', $objective->id) }}" method="POST" onsubmit="return confirm('Delete this?')">
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

{{-- Add Objective Modal --}}
<div class="modal fade" id="addObjectiveModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.objectives.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Objective</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea name="objective" class="form-control rich-editor" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Objective Modal --}}
<div class="modal fade" id="editObjectiveModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editObjectiveForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Objective</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea name="objective" id="editObjectiveInput" class="form-control rich-editor" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const objective = this.dataset.objective;

            // Set form action
            const form = document.getElementById('editObjectiveForm');
            form.action = `/admin/content/objectives/update/${id}`;

            // Autofill value
            document.getElementById('editObjectiveInput').value = objective;
        });
    });
</script>
@endsection
