<?php

namespace App\Models\admin\donations;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Table name if it's not the plural of model name
    protected $table = 'donation_transactions';

    // Mass assignable attributes
    protected $fillable = [
        'donor_id',
        'donation_amount',
        'payment_mode',
        'transaction_id',
        'cheque_number',
        'donation_date',
        'purpose',
        'remarks',
        'receipt_number',
        'created_by',
    ];

    // Use timestamps (created_at & updated_at)
    public $timestamps = true;

    // In Transaction.php
   public function donor()
  {
    return $this->belongsTo(Donor::class, 'donor_id');
  }

}
