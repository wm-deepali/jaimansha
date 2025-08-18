<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class DonateUs extends Model
{
    protected $table = 'donate_contents';

   protected $fillable = [
        'title',
        'slug',
        'description',
        'meta_description',
        'meta_keywords',
        'image',
        'status',
    ];

    public $timestamps=false;
}
