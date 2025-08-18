<?php

namespace App\Models\admin\membership;

use Illuminate\Database\Eloquent\Model;

class MembershipEnquiry extends Model
{

       // Specify the table name
    protected $table = 'memberships';

    // Disable updated_at (if not present)
    public $timestamps = false;

protected $fillable = [
    'package_id',
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
    'content',
    'membership_type', // add this if you're using it
];

     public function package()
    {
    return $this->belongsTo(Package::class, 'package_id', 'id');
    }

}
