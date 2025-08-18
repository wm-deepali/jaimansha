<?php

namespace App\Models\admin\membership;

use Illuminate\Database\Eloquent\Model;


class Package extends Model
{
    protected $table = 'manage_packages';

    protected $fillable = [
        'package_name',
        'amount',
        'duration',
        'description',
        'created_at'
    ];

    public $timestamps = false;

    public function memberships()
{
    return $this->hasMany(MembershipEnquiry::class, 'package_id', 'id');
}
}
