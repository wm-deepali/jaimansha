@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Donation Transactions</h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
            + Add Transaction
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Donor</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Transaction ID</th>
                <th>Cheque Number</th>
                <th>Donation Date</th>
                <th>Purpose</th>
                <th>Receipt No.</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->donor->full_name ?? 'N/A' }}</td>
                    <td>{{ $transaction->donation_amount }}</td>
                    <td>{{ ucfirst($transaction->payment_mode) }}</td>
                    <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ $transaction->cheque_number }}</td>
                    <td>{{ $transaction->donation_date }}</td>
                    <td>{{ $transaction->purpose }}</td>
                    <td>{{ $transaction->receipt_number }}</td>
                    <td>{{ $transaction->remarks }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn"
                            data-id="{{ $transaction->id }}"
                            data-donor_id="{{ $transaction->donor_id }}"
                            data-donation_amount="{{ $transaction->donation_amount }}"
                            data-payment_mode="{{ $transaction->payment_mode }}"
                            data-transaction_id="{{ $transaction->transaction_id }}"
                            data-cheque_number="{{ $transaction->cheque_number }}"
                            data-donation_date="{{ $transaction->donation_date }}"
                            data-purpose="{{ $transaction->purpose }}"
                            data-receipt_number="{{ $transaction->receipt_number }}"
                            data-remarks="{{ $transaction->remarks }}"
                            data-bs-toggle="modal" data-bs-target="#editTransactionModal">
                            Edit
                        </button>

                          <form action="{{ route('admin.donations.transactions.destroy', $transaction->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this donor?')">
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

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.donations.transactions.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Donor</label>
                        <select name="donor_id" class="form-control">
                            @foreach($donors as $donor)
                                <option value="{{ $donor->id }}">{{ $donor->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Donation Amount</label>
                        <input type="number" name="donation_amount" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Payment Mode</label>
                        <select name="payment_mode" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Cheque Number</label>
                        <input type="text" name="cheque_number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Donation Date</label>
                        <input type="date" name="donation_date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Purpose</label>
                        <input type="text" name="purpose" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Receipt Number</label>
                        <input type="text" name="receipt_number" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Remarks</label>
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Transaction Modal -->
<div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editTransactionForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="col-md-6">
                        <label>Donor</label>
                        <select name="donor_id" id="edit-donor_id" class="form-control">
                            @foreach($donors as $donor)
                                <option value="{{ $donor->id }}">{{ $donor->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Donation Amount</label>
                        <input type="number" name="donation_amount" id="edit-donation_amount" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Payment Mode</label>
                        <select name="payment_mode" id="edit-payment_mode" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="online">Online</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Transaction ID</label>
                        <input type="text" name="transaction_id" id="edit-transaction_id" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Cheque Number</label>
                        <input type="text" name="cheque_number" id="edit-cheque_number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Donation Date</label>
                        <input type="date" name="donation_date" id="edit-donation_date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Purpose</label>
                        <input type="text" name="purpose" id="edit-purpose" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Receipt Number</label>
                        <input type="text" name="receipt_number" id="edit-receipt_number" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Remarks</label>
                        <textarea name="remarks" id="edit-remarks" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const donor_id = this.dataset.donor_id;
            const donation_amount = this.dataset.donation_amount;
            const payment_mode = this.dataset.payment_mode;
            const transaction_id = this.dataset.transaction_id;
            const cheque_number = this.dataset.cheque_number;
            const donation_date = this.dataset.donation_date;
            const purpose = this.dataset.purpose;
            const receipt_number = this.dataset.receipt_number;
            const remarks = this.dataset.remarks;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-donor_id').value = donor_id;
            document.getElementById('edit-donation_amount').value = donation_amount;
            document.getElementById('edit-payment_mode').value = payment_mode;
            document.getElementById('edit-transaction_id').value = transaction_id;
            document.getElementById('edit-cheque_number').value = cheque_number;
            document.getElementById('edit-donation_date').value = donation_date;
            document.getElementById('edit-purpose').value = purpose;
            document.getElementById('edit-receipt_number').value = receipt_number;
            document.getElementById('edit-remarks').value = remarks;

            const actionUrl = `{{ url('admin/donations/transactions') }}/${id}`;
            document.getElementById('editTransactionForm').action = actionUrl;
        });
    });
</script>
@endsection
