<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\membership\Package;

class MembershipRegistation extends Model
{
    protected $table = 'memberships';

    public $timestamps = false;

    protected $fillable = [
        'membership_type',
        'package_id',
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

    // Relation with Package model
    public function package()
    {
        return $this->belongsTo(Package::class, 'membership_type', 'id');
    }
}
