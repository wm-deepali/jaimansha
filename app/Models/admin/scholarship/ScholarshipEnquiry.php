<?php

namespace App\Models\admin\scholarship;

use Illuminate\Database\Eloquent\Model;

class ScholarshipEnquiry extends Model
{
    protected $table = 'scholarship_enquiries';

    protected $fillable = [
        'scholarship_id',
        'name',
        'father_name',
        'mother_name', // ✅ added this
        'dob',
        'school_name',
        'class',
        'email',
        'mobile',
        'address',
        'state',
        'city',
        'special_circumstance',
        'status',
        'added_date'
    ];

    public $timestamps = false;

    public function scholarship()
    {
        return $this->belongsTo(ScholarshipForm::class, 'scholarship_id');
    }
}
