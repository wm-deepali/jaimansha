<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Introduction extends Model
{
     use HasFactory;

    protected $table = 'introductions';

    protected $fillable = [
        'heading',
        'detail_content',
    ];

       public function visionAndMission()
    {
        return $this->hasOne(VisionAndMission::class, 'id');
    }
}
