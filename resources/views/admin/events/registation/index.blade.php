@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Event Registrations</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Event Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($registrations as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('h:i A') }}</td>
                    <td>{{ $item->full_name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>{{ $item->event->event_name ?? 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $item->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $item->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info text-white viewBtn"
                            data-fullname="{{ $item->full_name }}"
                            data-email="{{ $item->email }}"
                            data-mobile="{{ $item->mobile }}"
                            data-event="{{ $item->event->event_name ?? 'N/A' }}"
                            data-status="{{ $item->status ? 'Active' : 'Inactive' }}"
                            data-created="{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y h:i A') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#viewModal">
                            View
                        </button>

                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $item->id }}"
                            data-fullname="{{ $item->full_name }}"
                            data-email="{{ $item->email }}"
                            data-mobile="{{ $item->mobile }}"
                            data-eventid="{{ $item->event_id }}"
                            data-status="{{ $item->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.events.registation.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this registration?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- View Modal --}}
    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registration Details</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Full Name:</strong> <span id="viewFullName"></span></p>
                    <p><strong>Email:</strong> <span id="viewEmail"></span></p>
                    <p><strong>Mobile:</strong> <span id="viewMobile"></span></p>
                    <p><strong>Event Name:</strong> <span id="viewEvent"></span></p>
                    <p><strong>Status:</strong> <span id="viewStatus"></span></p>
                    <p><strong>Registered At:</strong> <span id="viewCreated"></span></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Registration</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="full_name" id="editFullName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Mobile</label>
                            <input type="text" name="mobile" id="editMobile" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Event</label>
                            <select name="event_id" id="editEventId" class="form-select" required>
                                @foreach($registrations->pluck('event')->filter()->unique('id') as $event)
                                    <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" id="editStatus" class="form-select" required>
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
</div>

<script>
    document.querySelectorAll('.viewBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('viewFullName').innerText = this.dataset.fullname;
            document.getElementById('viewEmail').innerText = this.dataset.email;
            document.getElementById('viewMobile').innerText = this.dataset.mobile;
            document.getElementById('viewEvent').innerText = this.dataset.event;
            document.getElementById('viewStatus').innerText = this.dataset.status;
            document.getElementById('viewCreated').innerText = this.dataset.created;
        });
    });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('editForm').action = `/admin/registation/${this.dataset.id}`;
            document.getElementById('editFullName').value = this.dataset.fullname;
            document.getElementById('editEmail').value = this.dataset.email;
            document.getElementById('editMobile').value = this.dataset.mobile;
            document.getElementById('editEventId').value = this.dataset.eventid;
            document.getElementById('editStatus').value = this.dataset.status;
        });
    });
</script>
@endsection
