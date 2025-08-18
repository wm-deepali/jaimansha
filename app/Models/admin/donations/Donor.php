<?php

namespace App\Models\admin\donations;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    // Table name if it's not the plural of model name
    protected $table = 'donors';

    // Mass assignable attributes
    // protected $fillable = [
    //     'full_name',
    //     'email',
    //     'phone',
    //     'address',
    //     'city',
    //     'state',
    //     'country',
    //     'zip_code',
    //     'donor_type',
    //     'organization_name',
    //     'created_by',
    // ];
    protected $fillable = [
    'full_name',
    'email',
    'phone',
    'address',
    'city',
    'state',
    'country',
    'zip_code',
    'donor_type',
    'organization_name',
    'amount', // ✅ Ye zaroor ho
];


    // Use timestamps (created_at & updated_at)
    public $timestamps = true;
}
