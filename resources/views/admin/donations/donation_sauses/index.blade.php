@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Donation Sauses</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSauseModal">
            + Add Donation
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <!-- <th>#ID</th> -->
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>WhatsApp Number</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Pin Code</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Custom Amount</th>
                    <!--<th>Payment Method</th>-->
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $donation)
                    <tr>
                        <!-- <td>{{ $donation->id }}</td> -->
                        <td>
                            @if($donation->profile_picture)
                                <img src="{{ asset('public/' . $donation->profile_picture) }}" alt="Profile" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%; font-size: 14px;">
                                    {{ strtoupper(substr($donation->name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $donation->name }}</td>
                        <td>{{ $donation->email }}</td>
                        <td>{{ $donation->mobile_number ?? 'N/A' }}</td>
                        <td>
                            @if($donation->same_as_mobile)
                                <span class="badge bg-info">Same as Mobile</span>
                            @else
                                {{ $donation->whatsapp_number ?? 'N/A' }}
                            @endif
                        </td>
                        <td>{{ Str::limit($donation->full_address ?? 'N/A', 30) }}</td>
                        <td>{{ $donation->country ?? 'N/A' }}</td>
                        <td>{{ $donation->state ?? 'N/A' }}</td>
                        <td>{{ $donation->city ?? 'N/A' }}</td>
                        <td>{{ $donation->pin_code ?? 'N/A' }}</td>
                        <td>{{ $donation->category->name ?? 'N/A' }}</td>
                        <td>${{ $donation->amount }}</td>
                        <td>
                            @if($donation->custom_amount && $donation->custom_amount > 0)
                                ${{ number_format($donation->custom_amount, 2) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <!--<td>{{ $donation->payment_method }}</td>-->
                        <td>{{ $donation->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $donation->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm editBtn"
                                data-id="{{ $donation->id }}"
                                data-name="{{ $donation->name }}"
                                data-email="{{ $donation->email }}"
                                data-mobile_number="{{ $donation->mobile_number }}"
                                data-whatsapp_number="{{ $donation->whatsapp_number }}"
                                data-same_as_mobile="{{ $donation->same_as_mobile ? '1' : '0' }}"
                                data-full_address="{{ $donation->full_address }}"
                                data-country="{{ $donation->country }}"
                                data-state="{{ $donation->state }}"
                                data-city="{{ $donation->city }}"
                                data-pin_code="{{ $donation->pin_code }}"
                                data-donation_category_id="{{ $donation->donation_category_id }}"
                                data-amount="{{ $donation->amount }}"
                                data-custom_amount="{{ $donation->custom_amount }}"
                                data-payment_method="{{ $donation->payment_method }}"
                                data-bs-toggle="modal" data-bs-target="#editSauseModal">
                                Edit
                            </button>

                            <form action="{{ route('admin.donations.sauses.destroy', $donation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this donation?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $donations->links() }}
</div>

<!-- Add Donation Modal -->
<div class="modal fade" id="addSauseModal" tabindex="-1" aria-labelledby="addSauseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.donations.sauses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Donation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Personal Information -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-primary">Personal Information</h6>
                            
                            <div class="mb-3">
                                <label>Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="same_as_mobile" id="same_as_mobile" value="1" {{ old('same_as_mobile') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="same_as_mobile">
                                        WhatsApp number is same as mobile number
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3" id="whatsapp_field">
                                <label>WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number') }}">
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-primary">Address Information</h6>
                            
                            <div class="mb-3">
                                <label>Full Address</label>
                                <textarea name="full_address" class="form-control" rows="3">{{ old('full_address') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" value="{{ old('country') }}">
                            </div>

                            <div class="mb-3">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" value="{{ old('state') }}">
                            </div>

                            <div class="mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                            </div>

                            <div class="mb-3">
                                <label>Pin Code</label>
                                <input type="text" name="pin_code" class="form-control" value="{{ old('pin_code') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Donation Information -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="mb-3 text-primary">Donation Information</h6>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Donation Category</label>
                                <select name="donation_category_id" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('donation_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Amount (Select from predefined)</label>
                                <select name="amount" class="form-control">
                                    <option value="">-- Select Amount --</option>
                                    @foreach([10,20,30,40,50] as $amt)
                                        <option value="{{ $amt }}" {{ old('amount') == $amt ? 'selected' : '' }}>${{ $amt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Custom Amount (Enter your own amount)</label>
                                <input type="number" step="0.01" name="custom_amount" class="form-control" placeholder="Enter custom amount" value="{{ old('custom_amount') }}">
                            </div>

                            <!--<div class="mb-3">-->
                            <!--    <label>Payment Method</label>-->
                            <!--    <select name="payment_method" class="form-control" required>-->
                            <!--        <option value="">-- Select Payment Method --</option>-->
                            <!--        <option value="Test Donation" {{ old('payment_method') == 'Test Donation' ? 'selected' : '' }}>Test Donation</option>-->
                            <!--        <option value="Offline Donation" {{ old('payment_method') == 'Offline Donation' ? 'selected' : '' }}>Offline Donation</option>-->
                            <!--        <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>-->
                            <!--    </select>-->
                            <!--</div>-->
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Donation</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Donation Modal -->
<div class="modal fade" id="editSauseModal" tabindex="-1" aria-labelledby="editSauseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editSauseForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Donation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="edit-id">

                    <div class="row">
                        <!-- Personal Information -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-primary">Personal Information</h6>
                            
                            <div class="mb-3">
                                <label>Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control" accept="image/*">
                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" id="edit-email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile_number" id="edit-mobile_number" class="form-control">
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="same_as_mobile" id="edit-same_as_mobile" value="1">
                                    <label class="form-check-label" for="edit-same_as_mobile">
                                        WhatsApp number is same as mobile number
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3" id="edit-whatsapp_field">
                                <label>WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" id="edit-whatsapp_number" class="form-control">
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="col-md-6">
                            <h6 class="mb-3 text-primary">Address Information</h6>
                            
                            <div class="mb-3">
                                <label>Full Address</label>
                                <textarea name="full_address" id="edit-full_address" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Country</label>
                                <input type="text" name="country" id="edit-country" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>State</label>
                                <input type="text" name="state" id="edit-state" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>City</label>
                                <input type="text" name="city" id="edit-city" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Pin Code</label>
                                <input type="text" name="pin_code" id="edit-pin_code" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Donation Information -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="mb-3 text-primary">Donation Information</h6>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Donation Category</label>
                                <select name="donation_category_id" id="edit-donation_category_id" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Amount (Select from predefined)</label>
                                <select name="amount" id="edit-amount" class="form-control">
                                    <option value="">-- Select Amount --</option>
                                    @foreach([10,20,30,40,50] as $amt)
                                        <option value="{{ $amt }}">${{ $amt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Custom Amount (Enter your own amount)</label>
                                <input type="number" step="0.01" name="custom_amount" id="edit-custom_amount" class="form-control" placeholder="Enter custom amount">
                            </div>

                            <!--<div class="mb-3">-->
                            <!--    <label>Payment Method</label>-->
                            <!--    <select name="payment_method" id="edit-payment_method" class="form-control" required>-->
                            <!--        <option value="">-- Select Payment Method --</option>-->
                            <!--        <option value="Test Donation">Test Donation</option>-->
                            <!--        <option value="Offline Donation">Offline Donation</option>-->
                            <!--        <option value="Credit Card">Credit Card</option>-->
                            <!--    </select>-->
                            <!--</div>-->
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Donation</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Handle same as mobile checkbox for add modal
    document.getElementById('same_as_mobile').addEventListener('change', function() {
        const whatsappField = document.getElementById('whatsapp_field');
        if (this.checked) {
            whatsappField.style.display = 'none';
        } else {
            whatsappField.style.display = 'block';
        }
    });

    // Handle same as mobile checkbox for edit modal
    document.getElementById('edit-same_as_mobile').addEventListener('change', function() {
        const whatsappField = document.getElementById('edit-whatsapp_field');
        if (this.checked) {
            whatsappField.style.display = 'none';
        } else {
            whatsappField.style.display = 'block';
        }
    });

    // Handle edit button clicks
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('edit-id').value = this.dataset.id;
            document.getElementById('edit-name').value = this.dataset.name;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-mobile_number').value = this.dataset.mobile_number;
            document.getElementById('edit-whatsapp_number').value = this.dataset.whatsapp_number;
            
            // Handle same as mobile checkbox
            const sameAsMobile = this.dataset.same_as_mobile === '1';
            document.getElementById('edit-same_as_mobile').checked = sameAsMobile;
            const whatsappField = document.getElementById('edit-whatsapp_field');
            whatsappField.style.display = sameAsMobile ? 'none' : 'block';
            
            document.getElementById('edit-full_address').value = this.dataset.full_address;
            document.getElementById('edit-country').value = this.dataset.country;
            document.getElementById('edit-state').value = this.dataset.state;
            document.getElementById('edit-city').value = this.dataset.city;
            document.getElementById('edit-pin_code').value = this.dataset.pin_code;
            document.getElementById('edit-donation_category_id').value = this.dataset.donation_category_id;
            document.getElementById('edit-amount').value = this.dataset.amount;
            document.getElementById('edit-custom_amount').value = this.dataset.custom_amount;
            document.getElementById('edit-payment_method').value = this.dataset.payment_method;

            let actionUrl = `{{ url('admin/donations/sauses') }}/${this.dataset.id}`;
            document.getElementById('editSauseForm').action = actionUrl;
        });
    });
</script>

<style>
    .table-responsive {
        overflow-x: auto;
    }
    
    .table th, .table td {
        white-space: nowrap;
        vertical-align: middle;
    }
    
    .modal-lg {
        max-width: 900px;
    }
</style>
@endsection