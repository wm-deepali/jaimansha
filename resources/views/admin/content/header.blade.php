@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Header Content List</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addHeaderModal">
            + Add Header Info
        </button>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <!-- <th>ID</th> -->
                <th>Logo</th>
                <th>WhatsApp</th>
                <th>Helpline</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($headers as $header)
            <td>
                <!-- <td>#</td> -->
          <img src="{{ asset('public/' . $header->logo) }}" width="100" /></td>
                <td>{{ $header->mobileNumber }}</td>
                <td>{{ $header->helplineNumber }}</td>
                <td>{{ $header->email }}</td>
                <td>
                    <button class="btn btn-sm btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#editHeaderModal"
                        onclick='setEditData(@json($header))'>Edit</button>

                    <form action="{{ route('admin.header.delete', $header->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addHeaderModal" tabindex="-1" aria-labelledby="addHeaderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.header.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Header Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <!-- Add Form Fields -->
                    <div class="col-md-6 mb-3">
                        <label>WhatsApp Number</label>
                        <input type="text" name="mobileNumber" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Helpline Number</label>
                        <input type="text" name="helplineNumber" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email ID</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Logo Image</label>
                        <input type="file" name="logo" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Facebook</label>
                        <input type="text" name="facebook" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Twitter</label>
                        <input type="text" name="twitter" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>LinkedIn</label>
                        <input type="text" name="linkedin" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>YouTube</label>
                        <input type="text" name="youtube" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Google Plus</label>
                        <input type="text" name="gplus" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Pinterest</label>
                        <input type="text" name="pintreset" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Info</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editHeaderModal" tabindex="-1" aria-labelledby="editHeaderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editHeaderForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Header Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" value="POST">
                    <div class="mb-3">
                        <label>WhatsApp Number</label>
                        <input type="text" name="mobileNumber" id="edit_mobileNumber" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Helpline Number</label>
                        <input type="text" name="helplineNumber" id="edit_helplineNumber" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email ID</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Logo Image</label><br>
                        <img id="edit_logo_preview" src="" width="50" class="mb-2">
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Info</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script to handle edit modal --}}
<script>
    function setEditData(header) {
        document.getElementById('edit_mobileNumber').value = header.mobileNumber;
        document.getElementById('edit_helplineNumber').value = header.helplineNumber;
        document.getElementById('edit_email').value = header.email;
        document.getElementById('edit_logo_preview').src = "/" + header.logo;

        // Set dynamic action
        const form = document.getElementById('editHeaderForm');
        form.action = `/admin/header/update/${header.id}`;
    }
</script>
@endsection
