@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Scholarship Management</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addScholarshipModal">
            + Add Scholarship
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Level</th>
                <th>Amount</th>
                <th>Deadline</th>
                <th>Featured</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    @foreach($data as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->title }}</td>
    <td>{{ $item->level }}</td>
    <td>₹{{ number_format($item->amount) }}</td>
    <td>{{ $item->deadline }}</td>
    <td>{{ $item->is_featured ? 'Yes' : 'No' }}</td>
    <td>
        <button class="btn btn-sm btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#editScholarshipModal"

            data-id="{{ $item->id }}"
            data-title="{{ $item->title }}"
            data-slug="{{ $item->slug }}"
            data-description="{{ $item->description }}"
            data-eligibility="{{ $item->eligibility }}"
            data-benefits="{{ $item->benefits }}"
            data-application_process="{{ $item->application_process }}"
            data-document_required="{{ $item->document_required }}"
            data-amount="{{ $item->amount }}"
            data-deadline="{{ $item->deadline }}"
            data-category="{{ $item->category }}"
            data-level="{{ $item->level }}"
            data-contact_email="{{ $item->contact_email }}"
            data-official_website="{{ $item->official_website }}"
            data-is_featured="{{ $item->is_featured }}"
            data-meta_title="{{ $item->meta_title }}"
            data-meta_keywords="{{ $item->meta_keywords }}"
            data-meta_description="{{ $item->meta_description }}"
            data-status="{{ $item->status }}"

            onclick="setEditData(this)">Edit</button>

                <form action="{{ route('admin.scholarships.delete', $item->id) }}" method="GET" style="display:inline-block;">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

    </td>
</tr>
@endforeach

        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addScholarshipModal" tabindex="-1" aria-labelledby="addScholarshipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('admin.scholarships.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Scholarship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Eligibility</label>
                        <input type="text" name="eligibility" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Benefits</label>
                        <input type="text" name="benefits" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Application Process</label>
                        <input type="text" name="application_process" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Documents Required</label>
                        <input type="text" name="document_required" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Deadline</label>
                        <input type="date" name="deadline" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Level</label>
                        <input type="text" name="level" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Contact Email</label>
                        <input type="email" name="contact_email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Official Website</label>
                        <input type="text" name="official_website" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Meta Description</label>
                        <input type="text" name="meta_description" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Featured</label>
                        <select name="is_featured" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Scholarship</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editScholarshipModal" tabindex="-1" aria-labelledby="editScholarshipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editScholarshipForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Scholarship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" id="edit_slug" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Eligibility</label>
                        <input type="text" name="eligibility" id="edit_eligibility" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Benefits</label>
                        <input type="text" name="benefits" id="edit_benefits" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Application Process</label>
                        <input type="text" name="application_process" id="edit_application_process" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Documents Required</label>
                        <input type="text" name="document_required" id="edit_document_required" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" id="edit_amount" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Deadline</label>
                        <input type="date" name="deadline" id="edit_deadline" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <input type="text" name="category" id="edit_category" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Level</label>
                        <input type="text" name="level" id="edit_level" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Contact Email</label>
                        <input type="email" name="contact_email" id="edit_contact_email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Official Website</label>
                        <input type="url" name="official_website" id="edit_official_website" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Is Featured?</label>
                        <select name="is_featured" id="edit_is_featured" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" id="edit_meta_title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="edit_meta_keywords" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Meta Description</label>
                        <textarea name="meta_description" id="edit_meta_description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" id="edit_status" class="form-control">
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


<script>
function setEditData(button) {
    // Example: Prefill fields
    document.getElementById('edit_title').value = button.dataset.title;
    document.getElementById('edit_slug').value = button.dataset.slug;
    document.getElementById('edit_description').value = button.dataset.description;
    document.getElementById('edit_eligibility').value = button.dataset.eligibility;
    document.getElementById('edit_benefits').value = button.dataset.benefits;
    document.getElementById('edit_application_process').value = button.dataset.application_process;
    document.getElementById('edit_document_required').value = button.dataset.document_required;
    document.getElementById('edit_amount').value = button.dataset.amount;
    document.getElementById('edit_deadline').value = button.dataset.deadline;
    document.getElementById('edit_category').value = button.dataset.category;
    document.getElementById('edit_level').value = button.dataset.level;
    document.getElementById('edit_contact_email').value = button.dataset.contact_email;
    document.getElementById('edit_official_website').value = button.dataset.official_website;
    document.getElementById('edit_meta_title').value = button.dataset.meta_title;
    document.getElementById('edit_meta_keywords').value = button.dataset.meta_keywords;
    document.getElementById('edit_meta_description').value = button.dataset.meta_description;
    document.getElementById('edit_status').value = button.dataset.status;
    document.getElementById('edit_is_featured').checked = button.dataset.is_featured == "1";

    // Form action set dynamically (optional)
    document.getElementById('editScholarshipForm').action = `/admin/scholarships/update/${button.dataset.id}`;
}
</script>
@endsection
