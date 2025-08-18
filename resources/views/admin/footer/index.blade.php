@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Footer Contact Information</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFooterModal">
            Add Footer Info
        </button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Logo</th>
                    <th>Mobile</th>
                    <th>WhatsApp</th>
                    <th>Email</th>
                    <th>Short Content</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>
                            @if(!empty($contact->header->logo))
                                <img src="{{ asset('public/' . $contact->header->logo) }}" width="60">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $contact->header->mobileNumber ?? 'N/A' }}</td>
                        <td>{{ $contact->header->helplineNumber ?? 'N/A' }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{!! $contact->address ?? 'na' !!}</td>
                        <td>
                            <button class="btn btn-sm btn-primary editBtn"
                                data-id="{{ $contact->id }}"
                                data-mobile="{{ $contact->header->mobileNumber ?? '' }}"
                                data-whatsapp="{{ $contact->header->helplineNumber ?? '' }}"
                                data-email="{{ $contact->email }}"
                                data-address="{{ $contact->address }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editFooterModal">
                                Edit
                            </button>

                            <form action="{{ route('admin.footer.destroy', $contact->id) }}" method="POST" class="d-inline">
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
    <div class="modal fade" id="addFooterModal" tabindex="-1" aria-labelledby="addFooterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.footer.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Footer Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label>Short Content</label>
                            <textarea name="address" id="editor" rows="3" class="form-control"></textarea>
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
    <div class="modal fade" id="editFooterModal" tabindex="-1" aria-labelledby="editFooterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editFooterForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Footer Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label>Mobile</label>
                            <input type="text" name="mobile" id="edit-mobile" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" id="edit-whatsapp" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label>Short Content</label>
                            <textarea name="address" id="edit-editor" rows="3" class="form-control"></textarea>
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

{{-- CKEditor Script --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    let addEditor, editEditor;

    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            addEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#edit-editor'))
        .then(editor => {
            editEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-mobile').value = this.dataset.mobile;
            document.getElementById('edit-whatsapp').value = this.dataset.whatsapp;
            document.getElementById('edit-email').value = this.dataset.email;

            // Set rich text content
            if (editEditor) {
                editEditor.setData(this.dataset.address || '');
            } else {
                document.getElementById('edit-editor').value = this.dataset.address;
            }

            document.getElementById('editFooterForm').action = `/admin/footer/${id}`;
        });
    });
</script>
@endsection
