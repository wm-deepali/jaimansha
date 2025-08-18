<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisionAndMission extends Model
{
    use HasFactory;

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
