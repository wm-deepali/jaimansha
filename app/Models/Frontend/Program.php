<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'our_program';  // Table name specify

    public $timestamps = false; // If no created_at / updated_at columns

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

    // Cast JSON columns to array
    protected $casts = [
        'points' => 'array',
        'tabs' => 'array',
    ];
}
