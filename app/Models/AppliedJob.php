<?php

// app/Models/AppliedJob.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $table = 'applied_job'; // If table name is not plural
    protected $fillable = [
        'name', 'mobile', 'email', 'qualification',
        'applied_post', 'total_experience', 'resume_path', 'applied_date', 'message'
    ];
}
