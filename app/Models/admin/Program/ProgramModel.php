<?php

namespace App\Models\admin\Program;

use Illuminate\Database\Eloquent\Model;

class ProgramModel extends Model
{
    protected $table = 'our_program';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'text_1',
        'text_2',
        'points',
        'video_image',
        'video_url',
        'text_3',
        'tabs',
        'slug',
        'status',
        'added_date',
    ];

    // Full image path
    public function getVideoImageUrlAttribute()
    {
        return asset('uploads/programs/' . $this->video_image);
    }

    // Decode tabs JSON
    public function getTabsDecodedAttribute()
    {
        return json_decode($this->tabs, true);
    }

    // Decode points JSON
    public function getPointsDecodedAttribute()
    {
        return json_decode($this->points, true);
    }
}
