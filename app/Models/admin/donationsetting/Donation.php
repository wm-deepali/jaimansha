<?php

namespace App\Models\admin\donationsetting;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{

   public $table='donation_settings';

    protected $fillable = [
        'qr_code_url',
        'upi_id',
        'account_number',
        'account_name',
        'ifsc_code',
        'bank_name',
        'bank_branch',
        'whatsapp_number',
        'email',
    ];

    public $timestamps=true;
}


