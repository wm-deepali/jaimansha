<?php

namespace App\Models\admin\scholarship;

use Illuminate\Database\Eloquent\Model;

class ScholarshipContent extends Model
{
    protected $table = 'scholarship_content';

    protected $fillable = [
        'title_1',
        'title_2',
        'title_3',
        'short_description_1',
        'short_description_2',
    ];

    public $timestamps = true;
}
