<?php

namespace App\Http\Controllers\Admin\Donations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\donations\Transaction;
use App\Models\admin\donations\Donor;

class DonationTransactionController extends Controller
{
    // Show all donation transactions
  public function index()
{
    $transactions = Transaction::with('donor')->get();
    $donors = Donor::all();

    return view('admin.donations.transactions.index', compact('transactions', 'donors'));
}

    // Show create form
    public function create()
    {
        $donors = Donor::all();
        return view('admin.donations.transactions.create', compact('donors'));
    }

    // Store new donation transaction
    public function store(Request $request)
    {
        $request->validate([
            'donor_id'        => 'nullable|exists:donors,id',
            'donation_amount' => 'required|numeric|min:1',
            'payment_mode'    => 'required|in:cash,cheque,upi,bank_transfer,online',
            'transaction_id'  => 'nullable|string|max:100',
            'cheque_number'   => 'nullable|string|max:50',
            'donation_date'   => 'required|date',
            'purpose'         => 'nullable|string|max:255',
            'remarks'         => 'nullable|string',
            'receipt_number'  => 'nullable|string|max:100',
        ]);

        Transaction::create([
            'donor_id'        => $request->donor_id,
            'donation_amount' => $request->donation_amount,
            'payment_mode'    => $request->payment_mode,
            'transaction_id'  => $request->transaction_id,
            'cheque_number'   => $request->cheque_number,
            'donation_date'   => $request->donation_date,
            'purpose'         => $request->purpose,
            'remarks'         => $request->remarks,
            'receipt_number'  => $request->receipt_number, // logged-in user id
        ]);

        return redirect()->route('admin.donations.transactions.index')->with('success', 'Donation transaction recorded successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $donors = Donor::all();
        return view('admin.donations.transactions.edit', compact('transaction', 'donors'));
    }

    // Update existing transaction
    public function update(Request $request, $id)
    {
        $request->validate([
            'donor_id'        => 'nullable|exists:donors,id',
            'donation_amount' => 'required|numeric|min:1',
            'payment_mode'    => 'required|in:cash,cheque,upi,bank_transfer,online',
            'transaction_id'  => 'nullable|string|max:100',
            'cheque_number'   => 'nullable|string|max:50',
            'donation_date'   => 'required|date',
            'purpose'         => 'nullable|string|max:255',
            'remarks'         => 'nullable|string',
            'receipt_number'  => 'nullable|string|max:100',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'donor_id'        => $request->donor_id,
            'donation_amount' => $request->donation_amount,
            'payment_mode'    => $request->payment_mode,
            'transaction_id'  => $request->transaction_id,
            'cheque_number'   => $request->cheque_number,
            'donation_date'   => $request->donation_date,
            'purpose'         => $request->purpose,
            'remarks'         => $request->remarks,
            'receipt_number'  => $request->receipt_number,
        ]);

        return redirect()->route('admin.donations.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    // Delete transaction
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.donations.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
