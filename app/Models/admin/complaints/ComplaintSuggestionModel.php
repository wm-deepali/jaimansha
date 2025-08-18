<?php

namespace App\Models\admin\complaints;

use Illuminate\Database\Eloquent\Model;

class ComplaintSuggestionModel extends Model
{
    protected $table = 'complaints_suggestions';

    protected $fillable = [
        'type',
        'full_name',
        'email',
        'mobile_number',
        'details',
    ];

    public $timestamps=true;
}
