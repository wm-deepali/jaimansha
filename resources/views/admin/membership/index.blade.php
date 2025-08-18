@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Membership Page Content</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContentModal">
            Add Content
        </button>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Content Table --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Apply</th>
                    <th>Benefits</th>
                    <th>Fee Structure</th>
                    <th>Terms</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contents as $content)
                <tr>
                    <td>#</td>
                    <td>{!! Str::limit($content->apply, 50) !!}</td>
                    <td>{!! Str::limit($content->benefits, 50) !!}</td>
                    <td>{!! Str::limit($content->fee_structure, 50) !!}</td>
                    <td>{!! Str::limit($content->terms, 50) !!}</td>
                    <td>
                        <button class="btn btn-sm btn-info editBtn"
                            data-id="{{ $content->id }}"
                            data-apply="{{ $content->apply }}"
                            data-benefits="{{ $content->benefits }}"
                            data-fee_structure="{{ $content->fee_structure }}"
                            data-terms="{{ $content->terms }}"
                            data-bs-toggle="modal" data-bs-target="#editContentModal">
                            Edit
                        </button>

                        <form action="{{ route('admin.membership.destroy', $content->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No content found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Add Content Modal --}}
<div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.membership.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Membership Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label>Apply</label>
                        <textarea name="apply" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Benefits</label>
                        <textarea name="benefits" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Fee Structure</label>
                        <textarea name="fee_structure" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Terms & Conditions</label>
                        <textarea name="terms" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Content Modal --}}
<div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="" id="editForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Membership Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label>Apply</label>
                        <textarea name="apply" id="edit-apply" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Benefits</label>
                        <textarea name="benefits" id="edit-benefits" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Fee Structure</label>
                        <textarea name="fee_structure" id="edit-fee_structure" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Terms & Conditions</label>
                        <textarea name="terms" id="edit-terms" class="form-control rich-editor" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('edit-id').value = this.dataset.id;
$('#edit-apply').summernote('code', this.dataset.apply || '');
$('#edit-benefits').summernote('code', this.dataset.benefits || '');
$('#edit-fee_structure').summernote('code', this.dataset.fee_structure || '');
$('#edit-terms').summernote('code', this.dataset.terms || '');


            // Set dynamic form action
            const form = document.getElementById('editForm');
            form.action = `/admin/membership/${this.dataset.id}`;
        });
    });
</script>
@endsection
