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
                <th>Scholarship</th>
                <th>Name</th>
                <th>Father's Name</th>
                <th>DOB</th>
                <th>School</th>
                <th>Class</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>City</th>
                <th>Status</th>
                <th>Submitted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enquiries as $item)
            <tr>
                <!-- <td>{{ $loop->iteration }}</td> -->
                <td>{{ $item->scholarship->title }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->father_name }}</td>
                <td>{{ $item->dob }}</td>
                <td>{{ $item->school_name }}</td>
                <td>{{ $item->class }}</td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->city }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->added_date }}</td>
                <td>


    <button class="btn btn-sm btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#editScholarshipEnquiryModal"

        data-id="{{ $item->id }}"
        data-scholarship_id="{{ $item->scholarship_title }}"
        data-name="{{ $item->name }}"
        data-father_name="{{ $item->father_name }}"
        data-dob="{{ $item->dob }}"
        data-school_name="{{ $item->school_name }}"
        data-class="{{ $item->class }}"
        data-email="{{ $item->email }}"
        data-mobile="{{ $item->mobile }}"
        data-address="{{ $item->address }}"
        data-state="{{ $item->state }}"
        data-city="{{ $item->city }}"
        data-special_circumstance="{{ $item->special_circumstance }}"
        data-status="{{ $item->status }}"
        data-added_date="{{ $item->added_date }}"

        onclick="setEditEnquiryData(this)">
        Edit
    </button>



                    <form action="{{ route('admin.scholarshipenquiries.destroy', $item->id) }}" method="GET" style="display:inline-block;">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addScholarshipModal" tabindex="-1" aria-labelledby="addScholarshipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('admin.scholarshipenquiries.store') }}" method="POST" enctype="multipart/form-data">
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
<!-- Edit Scholarship Enquiry Modal -->
<div class="modal fade" id="editScholarshipEnquiryModal" tabindex="-1" aria-labelledby="editScholarshipEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editScholarshipForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Scholarship Enquiry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 mb-3">
                        <label>Scholarship Title</label>
                        <input type="text" id="edit_scholarship_title" name="scholarship_title" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" id="edit_name" name="name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Father's Name</label>
                        <input type="text" id="edit_father_name" name="father_name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>DOB</label>
                        <input type="date" id="edit_dob" name="dob" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>School Name</label>
                        <input type="text" id="edit_school_name" name="school_name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Class</label>
                        <input type="text" id="edit_class" name="class" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" id="edit_email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Mobile</label>
                        <input type="text" id="edit_mobile" name="mobile" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <input type="text" id="edit_address" name="address" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>State</label>
                        <input type="text" id="edit_state" name="state" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>City</label>
                        <input type="text" id="edit_city" name="city" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Special Circumstance</label>
                        <input type="text" id="edit_special_circumstance" name="special_circumstance" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select id="edit_status" name="status" class="form-control">
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
function setEditEnquiryData(button) {
    document.getElementById('edit_scholarship_title').value = button.getAttribute('data-scholarship_id');
    document.getElementById('edit_name').value = button.getAttribute('data-name');
    document.getElementById('edit_father_name').value = button.getAttribute('data-father_name');
    document.getElementById('edit_dob').value = button.getAttribute('data-dob');
    document.getElementById('edit_school_name').value = button.getAttribute('data-school_name');
    document.getElementById('edit_class').value = button.getAttribute('data-class');
    document.getElementById('edit_email').value = button.getAttribute('data-email');
    document.getElementById('edit_mobile').value = button.getAttribute('data-mobile');
    document.getElementById('edit_address').value = button.getAttribute('data-address');
    document.getElementById('edit_state').value = button.getAttribute('data-state');
    document.getElementById('edit_city').value = button.getAttribute('data-city');
    document.getElementById('edit_special_circumstance').value = button.getAttribute('data-special_circumstance');
    document.getElementById('edit_status').value = button.getAttribute('data-status');

    const form = document.getElementById('editScholarshipForm');
    form.action = `/admin/scholarshipenquiries/${button.getAttribute('data-id')}`;
}
</script>

@endsection
