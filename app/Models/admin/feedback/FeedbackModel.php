<?php

namespace App\Models\admin\Feedback;

use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
   protected $table = 'feedback';

   protected $fillable = [
        'name',
        'email',
        'mobile',
        'designation',
        'status',
        'message',
        'status',
        'date',
        'star_rating',
        'profile_picture'
    ];

    public $timestamps = false;
}
