@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Authors</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAuthorModal">+ Add Author</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Author Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Father Name</th>
                     <th>Email</th>
                    <th>Mobile</th>
                    <th>WhatsApp</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Pin Code</th>
                    <th>Social Profiles</th>
                    <th>Author Type</th>
                    <th>Registered By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $key => $author)
                    @if($author->author_type === 'magazine' || $author->author_type === 'both')
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><img src="{{ asset('public/uploads/authors/' . $author->image) }}" width="60"></td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->father_name }}</td>
<td>{{ $author->email }}</td>
                        <td>{{ $author->mobile_number }}</td>
                        <td>{{ $author->whatsapp_number }}</td>
                        <td>{{ $author->address }}</td>
                        <td>{{ $author->city }}, {{ $author->state }}, {{ $author->country }}</td>
                        <td>{{ $author->pin_code }}</td>
                        <td>
                            FB: {{ $author->facebook }}<br>
                            TW: {{ $author->twitter }}<br>
                            IN: {{ $author->linkedin }}<br>
                            YT: {{ $author->youtube }}
                        </td>
                        <td>{{ ucfirst($author->author_type) }}</td>
                        <td>{{ ucfirst($author->registered_by) }}</td>
                        <td>{{ $author->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm editBtn"
                                data-id="{{ $author->id }}"
                                data-name="{{ $author->name }}"
                                data-father_name="{{ $author->father_name }}"
    data-email="{{ $author->email }}"
                                data-mobile="{{ $author->mobile_number }}"
                                data-whatsapp="{{ $author->whatsapp_number }}"
                                data-address="{{ $author->address }}"
                                data-country="{{ $author->country }}"
                                data-state="{{ $author->state }}"
                                data-city="{{ $author->city }}"
                                data-pin="{{ $author->pin_code }}"
                                data-facebook="{{ $author->facebook }}"
                                data-twitter="{{ $author->twitter }}"
                                data-linkedin="{{ $author->linkedin }}"
                                data-youtube="{{ $author->youtube }}"
                                data-author_type="{{ $author->author_type }}"
                                data-status="{{ $author->status }}"
                                data-bs-toggle="modal" data-bs-target="#editAuthorModal">Edit</button>

                            <form action="{{ route('admin.emagazine.authors.destroy', $author->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this author?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addAuthorModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('admin.emagazine.authors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-4"><label>Name</label><input type="text" name="name" class="form-control" required></div>
                    <div class="col-md-4"><label>Father Name</label><input type="text" name="father_name" class="form-control"></div>
<div class="col-md-4"><label>Email</label><input type="email" name="email" class="form-control"></div>

                    <div class="col-md-4"><label>Mobile</label><input type="text" name="mobile_number" class="form-control" required></div>
                    <div class="col-md-4"><label>WhatsApp</label><input type="text" name="whatsapp_number" class="form-control"></div>
                    <div class="col-md-6"><label>Address</label><input type="text" name="address" class="form-control"></div>
                    <div class="col-md-2"><label>Country</label><input type="text" name="country" class="form-control"></div>
                    <div class="col-md-2"><label>State</label><input type="text" name="state" class="form-control"></div>
                    <div class="col-md-2"><label>City</label><input type="text" name="city" class="form-control"></div>
                    <div class="col-md-2"><label>Pin</label><input type="text" name="pin_code" class="form-control"></div>
                    <div class="col-md-3"><label>Facebook</label><input type="text" name="facebook" class="form-control"></div>
                    <div class="col-md-3"><label>Twitter</label><input type="text" name="twitter" class="form-control"></div>
                    <div class="col-md-3"><label>LinkedIn</label><input type="text" name="linkedin" class="form-control"></div>
                    <div class="col-md-3"><label>Youtube</label><input type="text" name="youtube" class="form-control"></div>
                    <div class="col-md-4"><label>Author Type</label>
                        <select name="author_type" class="form-control">
                            <option value="magazine">magazine</option>
                            <option value="publication">publication</option>
                            <option value="both">both</option>
                        </select>
                    </div>
                    <div class="col-md-4"><label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4"><label>Image</label><input type="file" name="image" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editAuthorModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form id="editAuthorForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <!-- Same fields as Add Modal -->
                    <div class="col-md-4"><label>Name</label><input type="text" name="name" id="edit-name" class="form-control"></div>
                    <div class="col-md-4"><label>Father Name</label><input type="text" name="father_name" id="edit-father_name" class="form-control"></div>
<div class="col-md-4"><label>Email</label><input type="email" name="email" id="edit-email" class="form-control"></div>

                    <div class="col-md-4"><label>Mobile</label><input type="text" name="mobile_number" id="edit-mobile" class="form-control"></div>
                    <div class="col-md-4"><label>WhatsApp</label><input type="text" name="whatsapp_number" id="edit-whatsapp" class="form-control"></div>
                    <div class="col-md-6"><label>Address</label><input type="text" name="address" id="edit-address" class="form-control"></div>
                    <div class="col-md-2"><label>Country</label><input type="text" name="country" id="edit-country" class="form-control"></div>
                    <div class="col-md-2"><label>State</label><input type="text" name="state" id="edit-state" class="form-control"></div>
                    <div class="col-md-2"><label>City</label><input type="text" name="city" id="edit-city" class="form-control"></div>
                    <div class="col-md-2"><label>Pin</label><input type="text" name="pin_code" id="edit-pin" class="form-control"></div>
                    <div class="col-md-3"><label>Facebook</label><input type="text" name="facebook" id="edit-facebook" class="form-control"></div>
                    <div class="col-md-3"><label>Twitter</label><input type="text" name="twitter" id="edit-twitter" class="form-control"></div>
                    <div class="col-md-3"><label>LinkedIn</label><input type="text" name="linkedin" id="edit-linkedin" class="form-control"></div>
                    <div class="col-md-3"><label>Youtube</label><input type="text" name="youtube" id="edit-youtube" class="form-control"></div>
                    <div class="col-md-4"><label>Author Type</label>
                        <select name="author_type" id="edit-author_type" class="form-control">
                            <option value="magazine">magazine</option>
                            <option value="publication">publication</option>
                            <option value="both">both</option>
                        </select>
                    </div>
                    <div class="col-md-4"><label>Status</label>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4"><label>Image</label><input type="file" name="image" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit JS -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = document.getElementById('editAuthorForm');
            const id = this.dataset.id;
            form.action = `/admin/emagazine/authors/update/${id}`;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-father_name').value = this.dataset.father_name;
document.getElementById('edit-email').value = this.dataset.email;

            document.getElementById('edit-mobile').value = this.dataset.mobile;
            document.getElementById('edit-whatsapp').value = this.dataset.whatsapp;
            document.getElementById('edit-address').value = this.dataset.address;
            document.getElementById('edit-country').value = this.dataset.country;
            document.getElementById('edit-state').value = this.dataset.state;
            document.getElementById('edit-city').value = this.dataset.city;
            document.getElementById('edit-pin').value = this.dataset.pin;
            document.getElementById('edit-facebook').value = this.dataset.facebook;
            document.getElementById('edit-twitter').value = this.dataset.twitter;
            document.getElementById('edit-linkedin').value = this.dataset.linkedin;
            document.getElementById('edit-youtube').value = this.dataset.youtube;
            document.getElementById('edit-author_type').value = this.dataset.author_type;
            document.getElementById('edit-status').value = this.dataset.status;
        });
    });
</script>
@endsection
