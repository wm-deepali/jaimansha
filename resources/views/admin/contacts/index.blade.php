@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Contacts</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContactModal">
            Add Contact
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Services</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->services }}</td>
                    <td>{!! \Illuminate\Support\Str::limit($contact->message, 20) !!}</td>
                    <td>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $contact->id }}"
                            data-name="{{ $contact->name }}"
                            data-email="{{ $contact->email }}"
                            data-phone="{{ $contact->phone }}"
                            data-subject="{{ $contact->subject }}"
                            data-services="{{ $contact->services }}"
                            data-message="{{ $contact->message }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editContactModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this contact?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
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
    <div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.contacts.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Services</label>
                            <input type="text" name="services" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Message</label>
                            <textarea name="message" class="form-control rich-editor" rows="4"></textarea>
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
    <div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editContactForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" id="edit-phone" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Subject</label>
                            <input type="text" name="subject" id="edit-subject" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Services</label>
                            <input type="text" name="services" id="edit-services" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Message</label>
                            <textarea name="message" id="edit-message" class="form-control rich-editor" rows="4"></textarea>
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
            const name = this.dataset.name;
            const email = this.dataset.email;
            const phone = this.dataset.phone;
            const subject = this.dataset.subject;
            const services = this.dataset.services;
            const message = this.dataset.message;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-phone').value = phone;
            document.getElementById('edit-subject').value = subject;
            document.getElementById('edit-services').value = services;
$('#edit-message').summernote('code', message || '');


            document.getElementById('editContactForm').action = `/admin/contacts/${id}`;
        });
    });
</script>
@endsection
