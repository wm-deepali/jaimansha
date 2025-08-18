<?php

namespace App\Models\admin\courses;

use Illuminate\Database\Eloquent\Model;

class AdmissionEnquiry extends Model
{
    protected $table = 'admission_enquiries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'course_interested',
        'message',
        'status'
    ];

    public $timestamps = true;

    // Optional relationship if needed
    public function course()
    {
        return $this->belongsTo(CourseContent::class, 'course_id');
    }
}
