<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class VisionAndMission extends Model
{
    // Table name explicitly defined (remove extra space from table name)
    protected $table = 'vision_and_mission';

    // Fillable columns based on your structure
    protected $fillable = [
        'heading',
        'description',
        'image',
        'status',
    ];

    public $timestamps = false;
}
