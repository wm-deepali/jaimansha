<?php

namespace App\Models\admin\membership;

use Illuminate\Database\Eloquent\Model;

class RegisteredMember extends Model
{
          // Specify the table name
    protected $table = 'memberships';

    // Disable updated_at (if not present)
    public $timestamps = false;

    // Allow mass assignment for these fields
    protected $fillable = [
        'membership_type',
        'amount',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'gender',
        'date_of_birth',
        'address',
        'country',
        'state',
        'city',
        'pin_code',
        'created_at',
    ];
}
