<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'event_name',
        'event_venue',
        'event_date',
        'event_time',
        'short_detail',
        'description',
        'thumb_image',
        'banner_image',
        'pdf',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
    ];

    public $timestamps=false;
}
