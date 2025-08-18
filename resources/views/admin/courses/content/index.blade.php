@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Courses</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">+ Add Course</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Fee</th>
                    <th>Offered Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $key => $course)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->category->category_name ?? 'N/A' }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>₹{{ $course->course_fee }}</td>
                    <td>₹{{ $course->offered_price }}</td>
                    <td>
                        <span class="badge {{ $course->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $course->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary editCourseBtn"
                            data-id="{{ $course->id }}"
                            data-name="{{ $course->course_name }}"
                            data-category="{{ $course->category_id }}"
                            data-duration="{{ $course->duration }}"
                            data-fee="{{ $course->course_fee }}"
                            data-discount-percentage="{{ $course->discount_percentage }}"
                            data-discount-amount="{{ $course->discount_amount }}"
                            data-offered-price="{{ $course->offered_price }}"
                            data-short-description="{{ $course->short_description }}"
                            data-detail="{{ $course->course_detail }}"
                            data-meta-title="{{ $course->meta_title }}"
                            data-meta-keywords="{{ $course->meta_keywords }}"
                            data-meta-description="{{ $course->meta_description }}"
                            data-status="{{ $course->status }}"
                            data-bs-toggle="modal" data-bs-target="#editCourseModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.courses.content.destroy', $course->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this course?')">
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

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('admin.courses.content.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>Course Name</label><input type="text" name="course_name" class="form-control" required></div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Duration</label><input type="text" name="duration" class="form-control"></div>
                    <div class="col-md-6"><label>Course Fee</label><input type="number" name="course_fee" class="form-control"></div>
                    <div class="col-md-6"><label>Discount %</label><input type="number" name="discount_percentage" class="form-control"></div>
                    <div class="col-md-6"><label>Discount Amount</label><input type="number" name="discount_amount" class="form-control"></div>
                    <div class="col-md-6"><label>Offered Price</label><input type="number" name="offered_price" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-12"><label>Short Description</label><textarea name="short_description" class="form-control rich-editor"></textarea></div>
                    <div class="col-md-12"><label>Course Detail</label><textarea name="course_detail" class="form-control rich-editor"></textarea></div>
                    <div class="col-md-6"><label>Meta Title</label><input type="text" name="meta_title" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Keywords</label><input type="text" name="meta_keywords" class="form-control"></div>
                    <div class="col-md-12"><label>Meta Description</label><textarea name="meta_description" class="form-control rich-editor"></textarea></div>
                    <div class="col-md-6"><label>Banner Image</label><input type="file" name="banner_image" class="form-control"></div>
                    <div class="col-md-6"><label>Thumbnail Image</label><input type="file" name="thumbnail_image" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Save</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <form id="editCourseForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="col-md-6"><label>Course Name</label><input type="text" name="course_name" id="edit-name" class="form-control" required></div>
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" id="edit-category" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Duration</label><input type="text" name="duration" id="edit-duration" class="form-control"></div>
                    <div class="col-md-6"><label>Course Fee</label><input type="number" name="course_fee" id="edit-fee" class="form-control"></div>
                    <div class="col-md-6"><label>Discount %</label><input type="number" name="discount_percentage" id="edit-discount-percentage" class="form-control"></div>
                    <div class="col-md-6"><label>Discount Amount</label><input type="number" name="discount_amount" id="edit-discount-amount" class="form-control"></div>
                    <div class="col-md-6"><label>Offered Price</label><input type="number" name="offered_price" id="edit-offered-price" class="form-control"></div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" id="edit-status" class="form-select">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-12"><label>Short Description</label><textarea name="short_description" id="edit-short-description" class="form-control rich-editor"></textarea></div>
                    <div class="col-md-12"><label>Course Detail</label><textarea name="course_detail" id="edit-detail" class="form-control rich-editor"></textarea></div>
                    <div class="col-md-6"><label>Meta Title</label><input type="text" name="meta_title" id="edit-meta-title" class="form-control"></div>
                    <div class="col-md-6"><label>Meta Keyword</label><input type="text" name="meta_keywords" id="edit-meta-keywords" class="form-control"></div>
                    <div class="col-md-12"><label>Meta Description</label><textarea name="meta_description" id="edit-meta-description" class="form-control rich-editor"></textarea></div>
                    <div class="col-md-6"><label>Banner Image</label><input type="file" name="banner_image" class="form-control"></div>
                    <div class="col-md-6"><label>Thumbnail Image</label><input type="file" name="thumbnail_image" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.editCourseBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = document.getElementById('editCourseForm');
            const id = this.dataset.id;
            form.action = `/admin/courses/content/update/${id}`;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-category').value = this.dataset.category;
            document.getElementById('edit-duration').value = this.dataset.duration;
            document.getElementById('edit-fee').value = this.dataset.fee;
            document.getElementById('edit-discount-percentage').value = this.dataset["discount-percentage"];
            document.getElementById('edit-discount-amount').value = this.dataset.discountAmount;
            document.getElementById('edit-offered-price').value = this.dataset.offeredPrice;
            document.getElementById('edit-short-description').value = this.dataset.shortDescription;
            document.getElementById('edit-detail').value = this.dataset.detail;
            document.getElementById('edit-meta-title').value = this.dataset.metaTitle;
            document.getElementById('edit-meta-keywords').value = this.dataset.metaKeywords;
            document.getElementById('edit-meta-description').value = this.dataset.metaDescription;
            document.getElementById('edit-status').value = this.dataset.status;
        });
    });
</script>
@endsection
