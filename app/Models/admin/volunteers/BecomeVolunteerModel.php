<?php

namespace App\Models\admin\volunteers;

use Illuminate\Database\Eloquent\Model;

class BecomeVolunteerModel extends Model
{
    protected $table = 'become_volunteers';

    protected $fillable = [
        'full_name',
        'email',
        'mobile_number',
        'address',
        'date_of_birth',
        'gender',
        'skills',
        'availability',
        'motivation',
        'experience',
        'emergency_contact',
        'emergency_mobile',
        'resume_file',
    ];

    public $timestamps=false;
}
