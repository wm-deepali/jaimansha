@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Membership Packages</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPackageModal">
            + Add Package
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Package Name</th>
                <th>Amount</th>
                <th>Duration</th>
                <th>Description</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($packages as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->package_name }}</td>
                <td>₹{{ number_format($item->amount, 2) }}</td>
                <td>{{ $item->duration }}</td>
<td>{{ \Illuminate\Support\Str::limit($item->description, 20) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                <td>
                    <button class="btn btn-sm btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#editPackageModal"
                        data-id="{{ $item->id }}"
                        data-package_name="{{ $item->package_name }}"
                        data-amount="{{ $item->amount }}"
                        data-duration="{{ $item->duration }}"
                        data-description="{{ $item->description }}"
                        onclick="setEditPackageData(this)">Edit</button>

                    <form action="{{ route('admin.membership.packages.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this package?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.membership.packages.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 mb-3">
                        <label>Package Name</label>
                        <input type="text" name="package_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" step="0.01" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Duration</label>
                        <input type="text" name="duration" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control rich-editor" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Package</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Package Modal -->
<div class="modal fade" id="editPackageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editPackageForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 mb-3">
                        <label>Package Name</label>
                        <input type="text" name="package_name" id="edit_package_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" id="edit_amount" step="0.01" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Duration</label>
                        <input type="text" name="duration" id="edit_duration" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" id="edit_description" class="form-control rich-editor" rows="3"></textarea>
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
function setEditPackageData(button) {
    document.getElementById('edit_package_name').value = button.dataset.package_name;
    document.getElementById('edit_amount').value = button.dataset.amount;
    document.getElementById('edit_duration').value = button.dataset.duration;
$('#edit_description').summernote('code', button.dataset.description || '');

    document.getElementById('editPackageForm').action = `/admin/membership/packages/update/${button.dataset.id}`;
}
</script>
@endsection
