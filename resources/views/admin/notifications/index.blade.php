@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Membership Notifications</h4>

    <!-- Add Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addNotificationModal">Add Notification</button>

    <!-- Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Membership Type</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($memberships as $notification)
                <tr>
                    <td>{{ $notification->membership->membership_type ?? 'N/A' }}</td>
                    <td>{{ $notification->title }}</td>
                    <td>{!! $notification->description !!}</td>
                    <td>
                        <button
                            class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $notification->id }}"
                            data-membership_id="{{ $notification->membership_id }}"
                            data-title="{{ $notification->title }}"
                            data-description="{{ $notification->description }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editNotificationModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addNotificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.notifications.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Membership Type</label>
                        <select name="membership_id" class="form-select" required>
                            <option value="">Select Membership</option>
                            @foreach($membershipTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->membership_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control rich-editor"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editNotificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editNotificationForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label>Membership Type</label>
                        <select name="membership_id" id="edit-membership_id" class="form-select" required>
                            <option value="">Select Membership</option>
                            @foreach($membershipTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->membership_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" id="edit-title" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea id="edit-description" name="description" class="form-control rich-editor"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const membership_id = this.dataset.membership_id;
            const title = this.dataset.title;
            const description = this.dataset.description;

            const form = document.getElementById('editNotificationForm');
            form.action = `/admin/notifications/${id}`;
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-membership_id').value = membership_id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-description').value = description;
        });
    });
</script>

@endsection
