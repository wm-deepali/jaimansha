<?php

namespace App\Models\admin\event;

use Illuminate\Database\Eloquent\Model;

class EventManagement extends Model
{
   protected $table = 'events';

protected $fillable = [
    'event_name',
    'event_venue',
    'event_date',
    'event_time',
    'mobile_number',
    'short_detail',
    'description',
    'event_details',
    'events_point_para',
    'event_last_heading',
    'event_last_para',
    'thumb_image',
    'banner_image',
    'pdf_file',
    'slug',
    'meta_title',
    'meta_keywords',
    'meta_description',
    'status',
];


    public $timestamps=false;
}
