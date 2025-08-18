<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'awards';

    protected $fillable = [
        'title',
        'pdf',
        'year',
        'status',
        'type'
    ];

    public $timestamps = false;
}
