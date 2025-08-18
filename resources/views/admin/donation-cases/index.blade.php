@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Donation Cases</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCaseModal">+ Add Case</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Donation Cases Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Short Description</th>
                     <th>Full Description</th>
                    <th>Required</th>
                    <th>Raised</th>
                    <th>Target Days</th>
                    <th>Supports</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cases as $key => $case)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><img src="{{ asset('public/uploads/donations/' . $case->image) }}" width="60"></td>
                       <td>{{ \Illuminate\Support\Str::limit($case->title, 20) }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($case->short_description), 20) !!}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($case->full_description), 20) !!}</td>

                        <td>{{ $case->donation_required }}</td>
                        <td>{{ $case->donation_raised }}</td>
                        <td>{{ $case->target_days }}</td>
                        <td>{{ $case->supports_count }}</td>
                        <td>{{ $case->category->name ?? '-' }}</td>
                        <td>{{ $case->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm editBtn"
                                data-id="{{ $case->id }}"
                                data-title="{{ $case->title }}"
                                data-short_description="{{ $case->short_description }}"
                                data-full_description="{{ $case->full_description }}"
                                data-donation_required="{{ $case->donation_required }}"
                                data-donation_raised="{{ $case->donation_raised }}"
                                data-target_days="{{ $case->target_days }}"
                                data-supports_count="{{ $case->supports_count }}"
                                data-category_id="{{ $case->category_id }}"
                                data-status="{{ $case->status }}"
                                data-bs-toggle="modal" data-bs-target="#editCaseModal">Edit</button>

                            <form action="{{ route('admin.donation-cases.destroy', $case->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this case?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Case Modal -->
<div class="modal fade" id="addCaseModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('admin.donation-cases.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Donation Case</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>Title</label><input type="text" name="title" class="form-control" required></div>
                    <div class="col-md-6"><label>Image</label><input type="file" name="image" class="form-control"></div>
                    <div class="col-md-12"><label>Short Description</label><textarea name="short_description" class="form-control rich-editor" required></textarea></div>
                    <div class="col-md-12"><label>Full Description</label><textarea name="full_description" class="form-control rich-editor" rows="4"></textarea></div>
                    <div class="col-md-3"><label>Donation Required</label><input type="number" name="donation_required" class="form-control" required></div>
                    <div class="col-md-3"><label>Donation Raised</label><input type="number" name="donation_raised" class="form-control" value="0"></div>
                    <div class="col-md-3"><label>Target Days</label><input type="number" name="target_days" class="form-control"></div>
                    <div class="col-md-3"><label>Supports Count</label><input type="number" name="supports_count" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Case Modal -->
<div class="modal fade" id="editCaseModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form id="editCaseForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Donation Case</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="col-md-6"><label>Title</label><input type="text" name="title" id="edit-title" class="form-control"></div>
                    <div class="col-md-6"><label>Image</label><input type="file" name="image" class="form-control"></div>
                    <div class="col-md-12"><label>Short Description</label><textarea name="short_description" id="edit-short" class="form-control rich-editor"></textarea></div>
                    <div class="col-md-12"><label>Full Description</label><textarea name="full_description" id="edit-full" class="form-control rich-editor" rows="4"></textarea></div>
                    <div class="col-md-3"><label>Donation Required</label><input type="number" name="donation_required" id="edit-required" class="form-control"></div>
                    <div class="col-md-3"><label>Donation Raised</label><input type="number" name="donation_raised" id="edit-raised" class="form-control"></div>
                    <div class="col-md-3"><label>Target Days</label><input type="number" name="target_days" id="edit-days" class="form-control"></div>
                    <div class="col-md-3"><label>Supports Count</label><input type="number" name="supports_count" id="edit-supports" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" id="edit-category" class="form-control">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Status</label>
                        <select name="status" id="edit-status" class="form-control">
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

<!-- Edit JS -->
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = document.getElementById('editCaseForm');
            const id = this.dataset.id;
            form.action = `/admin/donation-cases/${id}`;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = this.dataset.title;
             $('#edit-short').summernote('code', this.dataset.short_description);
        $('#edit-full').summernote('code', this.dataset.full_description);
            document.getElementById('edit-required').value = this.dataset.donation_required;
            document.getElementById('edit-raised').value = this.dataset.donation_raised;
            document.getElementById('edit-days').value = this.dataset.target_days;
            document.getElementById('edit-supports').value = this.dataset.supports_count;
            document.getElementById('edit-category').value = this.dataset.category_id;
            document.getElementById('edit-status').value = this.dataset.status;
        });
    });
</script>
@endsection
