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
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $key => $author)
                    @if($author->author_type === 'publication' || $author->author_type === 'both')
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($author->image)
                                <img src="{{ asset('public/uploads/authors/'.$author->image) }}" alt="Image" width="50" height="50" style="object-fit: cover;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->father_name ?? 'N/A' }}</td>
                        <td>{{ $author->email ?? 'N/A' }}</td>
                        <td>{{ $author->mobile_number ?? 'N/A' }}</td>
                        <td>{{ $author->whatsapp_number ?? 'N/A' }}</td>
                        <td>{{ $author->address ?? 'N/A' }}</td>
                        <td>{{ $author->city }}, {{ $author->state }}, {{ $author->country }}</td>
                        <td>{{ $author->pin_code ?? 'N/A' }}</td>
                        <td>
                            @if($author->facebook)<a href="{{ $author->facebook }}" target="_blank">FB</a><br>@endif
                            @if($author->twitter)<a href="{{ $author->twitter }}" target="_blank">TW</a><br>@endif
                            @if($author->linkedin)<a href="{{ $author->linkedin }}" target="_blank">IN</a><br>@endif
                            @if($author->youtube)<a href="{{ $author->youtube }}" target="_blank">YT</a>@endif
                        </td>
                        <td>{{ ucfirst($author->author_type) }}</td>
                        <td>{{ ucfirst($author->registered_by) }}</td>
                        <td>
                            <span class="badge {{ $author->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $author->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            @if($author->pdf)
                                <a href="{{ asset('public/'.$author->pdf) }}" target="_blank" class="btn btn-sm btn-outline-primary">View PDF</a>
                            @else
                                <span class="text-muted">No PDF</span>
                            @endif
                        </td>
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

                            <form action="{{ route('admin.publications.authors.destroy', $author->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this author?')">
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
        <form action="{{ route('admin.publications.authors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father Name</label>
                        <input type="text" name="father_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pin Code</label>
                        <input type="text" name="pin_code" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" name="facebook" class="form-control" placeholder="https://facebook.com/username">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Twitter URL</label>
                        <input type="url" name="twitter" class="form-control" placeholder="https://twitter.com/username">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/username">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">YouTube URL</label>
                        <input type="url" name="youtube" class="form-control" placeholder="https://youtube.com/@username">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Author Type</label>
                        <select name="author_type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="magazine">Magazine</option>
                            <option value="publication" selected>Publication</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Image</label>
                        <input type="file" name="publication_image" class="form-control" accept="image/*">
                        <small class="text-muted">Max: 20MB (jpg, jpeg, png)</small>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">PDF Document</label>
                        <input type="file" name="pdf" class="form-control" accept="application/pdf">
                        <small class="text-muted">Max: 20MB (PDF only)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Author</button>
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
                    <div class="col-md-6">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father Name</label>
                        <input type="text" name="father_name" id="edit-father_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile_number" id="edit-mobile" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" id="edit-whatsapp" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <textarea name="address" id="edit-address" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" id="edit-country" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <input type="text" name="state" id="edit-state" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" id="edit-city" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Pin Code</label>
                        <input type="text" name="pin_code" id="edit-pin" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" name="facebook" id="edit-facebook" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Twitter URL</label>
                        <input type="url" name="twitter" id="edit-twitter" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin" id="edit-linkedin" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">YouTube URL</label>
                        <input type="url" name="youtube" id="edit-youtube" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Author Type</label>
                        <select name="author_type" id="edit-author_type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="magazine">Magazine</option>
                            <option value="publication">Publication</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit-status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Image</label>
                        <input type="file" name="publication_image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">PDF Document</label>
                        <input type="file" name="pdf" class="form-control" accept="application/pdf">
                        <small class="text-muted">Leave empty to keep current PDF</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Author</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Edit Modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const form = document.getElementById('editAuthorForm');
            const id = this.dataset.id;
            
            // Set form action to correct route
            form.action = `/admin/publications/authors/update/${id}`;

            // Populate form fields
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = this.dataset.name || '';
            document.getElementById('edit-father_name').value = this.dataset.father_name || '';
            document.getElementById('edit-email').value = this.dataset.email || '';
            document.getElementById('edit-mobile').value = this.dataset.mobile || '';
            document.getElementById('edit-whatsapp').value = this.dataset.whatsapp || '';
            document.getElementById('edit-address').value = this.dataset.address || '';
            document.getElementById('edit-country').value = this.dataset.country || '';
            document.getElementById('edit-state').value = this.dataset.state || '';
            document.getElementById('edit-city').value = this.dataset.city || '';
            document.getElementById('edit-pin').value = this.dataset.pin || '';
            document.getElementById('edit-facebook').value = this.dataset.facebook || '';
            document.getElementById('edit-twitter').value = this.dataset.twitter || '';
            document.getElementById('edit-linkedin').value = this.dataset.linkedin || '';
            document.getElementById('edit-youtube').value = this.dataset.youtube || '';
            document.getElementById('edit-author_type').value = this.dataset.author_type || '';
            document.getElementById('edit-status').value = this.dataset.status || '1';
        });
    });
});
</script>

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function() {
    alert('Validation Error: {{ $errors->first() }}');
});
</script>
@endif

@endsection
