<?php

namespace App\Models\admin\membership;

use Illuminate\Database\Eloquent\Model;

class MembershipPage extends Model
{
    // Table name (agar Laravel convention follow nahi ho rahi)
    protected $table = 'membership_content';

    // Mass assignable attributes
    protected $fillable = [
        'apply',
        'benefits',
        'fee_structure',
        'terms',
    ];

    // Timestamps true (agar created_at / updated_at ka use ho raha ho)
    public $timestamps = true;
}
