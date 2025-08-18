<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $table = 'donate_contents';

    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
    ];

    public $timestamps=false;
}
