@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Donation Settings</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDonationModal">+ Add Setting</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Donation Settings Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>QR Code</th>
                    <th>UPI ID</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                    <th>IFSC Code</th>
                    <th>Bank Name</th>
                    <th>Bank Branch</th>
                    <th>WhatsApp</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $key => $donation)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                       <td>
    @if($donation->qr_code_url && file_exists(public_path($donation->qr_code_url)))
        <img src="{{ asset( 'public/'.$donation->qr_code_url) }}" width="60">
    @else
        -
    @endif
</td>
                        <td>{{ $donation->upi_id }}</td>
                        <td>{{ $donation->account_number }}</td>
                        <td>{{ $donation->account_name }}</td>
                        <td>{{ $donation->ifsc_code }}</td>
                        <td>{{ $donation->bank_name }}</td>
                        <td>{{ $donation->bank_branch }}</td>
                        <td>{{ $donation->whatsapp_number }}</td>
                        <td>{{ $donation->email }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm editBtn"
                                data-id="{{ $donation->id }}"
                                data-qr_code_url="{{ $donation->qr_code_url }}"
                                data-upi_id="{{ $donation->upi_id }}"
                                data-account_number="{{ $donation->account_number }}"
                                data-account_name="{{ $donation->account_name }}"
                                data-ifsc_code="{{ $donation->ifsc_code }}"
                                data-bank_name="{{ $donation->bank_name }}"
                                data-bank_branch="{{ $donation->bank_branch }}"
                                data-whatsapp_number="{{ $donation->whatsapp_number }}"
                                data-email="{{ $donation->email }}"
                                data-bs-toggle="modal" data-bs-target="#editDonationModal">Edit</button>

                            <form action="{{ route('admin.donation.destroy', $donation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this donation setting?')">
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

<!-- Add Donation Modal -->
<div class="modal fade" id="addDonationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.donation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Donation Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label>QR Code</label><input type="file" name="qr_code_url" class="form-control"></div>
                    <div class="col-md-6"><label>UPI ID</label><input type="text" name="upi_id" class="form-control"></div>
                    <div class="col-md-6"><label>Account Number</label><input type="text" name="account_number" class="form-control"></div>
                    <div class="col-md-6"><label>Account Name</label><input type="text" name="account_name" class="form-control"></div>
                    <div class="col-md-6"><label>IFSC Code</label><input type="text" name="ifsc_code" class="form-control"></div>
                    <div class="col-md-6"><label>Bank Name</label><input type="text" name="bank_name" class="form-control"></div>
                    <div class="col-md-6"><label>Bank Branch</label><input type="text" name="bank_branch" class="form-control"></div>
                    <div class="col-md-6"><label>WhatsApp Number</label><input type="text" name="whatsapp_number" class="form-control"></div>
                    <div class="col-md-6"><label>Email</label><input type="email" name="email" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Donation Modal -->
<div class="modal fade" id="editDonationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="editDonationForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Donation Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="col-md-6"><label>QR Code</label><input type="file" name="qr_code_url" class="form-control"></div>
                    <div class="col-md-6"><label>UPI ID</label><input type="text" name="upi_id" id="edit-upi_id" class="form-control"></div>
                    <div class="col-md-6"><label>Account Number</label><input type="text" name="account_number" id="edit-account_number" class="form-control"></div>
                    <div class="col-md-6"><label>Account Name</label><input type="text" name="account_name" id="edit-account_name" class="form-control"></div>
                    <div class="col-md-6"><label>IFSC Code</label><input type="text" name="ifsc_code" id="edit-ifsc_code" class="form-control"></div>
                    <div class="col-md-6"><label>Bank Name</label><input type="text" name="bank_name" id="edit-bank_name" class="form-control"></div>
                    <div class="col-md-6"><label>Bank Branch</label><input type="text" name="bank_branch" id="edit-bank_branch" class="form-control"></div>
                    <div class="col-md-6"><label>WhatsApp Number</label><input type="text" name="whatsapp_number" id="edit-whatsapp_number" class="form-control"></div>
                    <div class="col-md-6"><label>Email</label><input type="email" name="email" id="edit-email" class="form-control"></div>
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
        const form = document.getElementById('editDonationForm');
        const id = this.dataset.id;

        // ✅ Correct route
        form.action = `/admin/donation/${id}`;

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-upi_id').value = this.dataset.upi_id;
        document.getElementById('edit-account_number').value = this.dataset.account_number;
        document.getElementById('edit-account_name').value = this.dataset.account_name;
        document.getElementById('edit-ifsc_code').value = this.dataset.ifsc_code;
        document.getElementById('edit-bank_name').value = this.dataset.bank_name;
        document.getElementById('edit-bank_branch').value = this.dataset.bank_branch;
        document.getElementById('edit-whatsapp_number').value = this.dataset.whatsapp_number;
        document.getElementById('edit-email').value = this.dataset.email;
    });
});

</script>
@endsection
