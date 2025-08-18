@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Admission Enquiries</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Enquiry Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addEnquiryModal">
        + Add Enquiry
    </button>

    <!-- Enquiries Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Course</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquiries as $index => $enquiry)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $enquiry->course_interested }}</td>
                    <td>{{ $enquiry->name }}</td>
                    <td>{{ $enquiry->phone }}</td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{!! \Illuminate\Support\Str::limit(strip_tags($enquiry->message), 20) !!}</td>

                    <td>{{ ucfirst($enquiry->status) }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $enquiry->id }}"
                            data-course_interested="{{ $enquiry->course_interested }}"
                            data-name="{{ $enquiry->name }}"
                            data-phone="{{ $enquiry->phone }}"
                            data-email="{{ $enquiry->email }}"
                            data-message="{{ $enquiry->message }}"
                            data-status="{{ $enquiry->status }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editEnquiryModal">
                            Edit
                        </button>
                        <form action="{{ route('admin.courses.admissionenquiries.destroy', $enquiry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
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

<!-- Add Modal -->
<div class="modal fade" id="addEnquiryModal" tabindex="-1" aria-labelledby="addEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.courses.admissionenquiries.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addEnquiryModalLabel">Add Enquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label class="form-label">Course Interested</label>
                    <select name="course_interested" class="form-control" required>
                        <option value="" disabled selected>Select Course</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control rich-editor" rows="3"></textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="new">New</option>
                        <option value="contacted">Contacted</option>
                        <option value="resolved">Resolved</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Enquiry</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editEnquiryModal" tabindex="-1" aria-labelledby="editEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editEnquiryModalLabel">Edit Enquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit-id">
                <div class="mb-2">
                    <label class="form-label">Course Interested</label>
                    <input type="text" name="course_interested" id="edit-course_interested" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" id="edit-name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" id="edit-phone" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="edit-email" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Message</label>
                    <textarea name="message" id="edit-message" class="form-control rich-editor" rows="3"></textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label">Status</label>
                    <select name="status" id="edit-status" class="form-select" required>
                        <option value="new">New</option>
                        <option value="contacted">Contacted</option>
                        <option value="resolved">Resolved</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Enquiry</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal Script -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editForm');
            form.action = `/admin/courses/admissionenquiries/update/${id}`;

            // Set form values
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-course_interested').value = this.dataset.course_interested;
            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-phone').value = this.dataset.phone;
            document.getElementById('edit-email').value = this.dataset.email;
            $('#edit-message').summernote('code', this.dataset.message || '');


            // If status is a checkbox (optional):
            // document.getElementById('edit-status').checked = this.dataset.status == 1;

            // If status is a dropdown:
            document.getElementById('edit-status').value = this.dataset.status;
        });
    });
</script>

@endsection
