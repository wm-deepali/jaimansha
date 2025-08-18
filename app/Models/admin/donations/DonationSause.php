<?php

namespace App\Models\admin\donations;

use Illuminate\Database\Eloquent\Model;

class DonationSause extends Model
{
    protected $table = 'donation_sauses';

    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'whatsapp_number',
        'same_as_mobile',
        'full_address',
        'country',
        'state',
        'city',
        'pin_code',
        'profile_picture',
        'donation_category_id',
        'amount',
        'custom_amount',
        // 'payment_method',
    ];

    public function category()
    {
        return $this->belongsTo(DonationCategory::class, 'donation_category_id');
    }
}
