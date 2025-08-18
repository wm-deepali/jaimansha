<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team_members';

    // Fillable columns based on your structure
    protected $fillable = [
        'name',
        'designation',
        'image',
        'status',
        'joined_at',
        'team_type',
    ];

    public $timestamps = false;
}
