<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
     protected $table = 'slider_settings';
    public $timestamps = false;

    protected $fillable = [
        'subtitle',
        'title',
        'fixed_title',
        'fixed_color_title',
        'animation_text',
        'button_text',
        'image',
        'video_url',
        'status',
    ];

}
