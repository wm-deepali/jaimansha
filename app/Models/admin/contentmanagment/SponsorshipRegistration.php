<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class SponsorshipRegistration extends Model
{
    protected $table = 'sponsorship_registrations';

    protected $fillable = [
        'sponsorship_type',
        'full_name',
        'email',
        'mobile',
        'company_name',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'detail',
    ];

    public $timestamps = false;
}
