@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Team Members</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#teamModal" onclick="resetForm()">+ Add Member</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo/Pdf</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Status</th>
                <th>Team Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $index => $member)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($member->image)
                        @if($member->team_type == 'advisor')
                            <!-- Advisor ke liye PDF icon -->
                            <a href="{{ asset('public/uploads/team/pdfs/' . $member->image) }}" target="_blank">
                                <img src="{{ asset('frontend/admin/assets/images/pdf-icon.png') }}" width="40" alt="PDF">
                            </a>
                        @else
                            <img src="{{ asset('public/uploads/team/' . $member->image) }}" width="60" alt="{{ $member->name }}">
                        @endif
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->designation }}</td>
                <td>{{ ucfirst($member->status) }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $member->team_type)) }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick='setEditData(@json($member))' data-bs-toggle="modal" data-bs-target="#teamModal">Edit</button>
                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" id="teamForm" action="{{ route('admin.team.store') }}">
            @csrf
            <input type="hidden" name="edit_id" id="edit_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Team Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="designation" id="designation" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="team_type" class="form-label">Team Type<span class="text-danger">*</span></label>
                        <select name="team_type" id="team_type" class="form-select" required>
                            <option value="our_team">Our Team</option>
                            <option value="volunteers">Volunteers</option>
                            <option value="advisor">Advisor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Photo / PDF</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <img id="image_preview" src="" width="100" class="mt-2 d-none">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Member</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function setEditData(member) {
        document.getElementById('edit_id').value = member.id || '';
        document.getElementById('name').value = member.name || '';
        document.getElementById('designation').value = member.designation || '';
        document.getElementById('status').value = member.status || 'active';
        document.getElementById('team_type').value = member.team_type || 'our_team';

        const preview = document.getElementById('image_preview');
        if (member.image) {
            if(member.team_type == 'advisor'){
                preview.src = 'frontend/admin/assets/images/pdf-icon.png';
            } else {
                preview.src = 'frontend/uploads/team/' + member.image;
            }
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }

        document.getElementById('teamForm').action = `/admin/team/${member.id}`;
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('teamForm').appendChild(methodInput);
    }

    function resetForm() {
        document.getElementById('edit_id').value = '';
        document.getElementById('name').value = '';
        document.getElementById('designation').value = '';
        document.getElementById('status').value = 'active';
        document.getElementById('team_type').value = 'our_team';
        document.getElementById('image_preview').src = '';
        document.getElementById('image_preview').classList.add('d-none');
        document.getElementById('teamForm').action = '{{ route("admin.team.store") }}';

        const methodInput = document.querySelector('#teamForm input[name="_method"]');
        if (methodInput) methodInput.remove();
    }
</script>
@endsection


