<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
      // Table name explicitly defined (remove extra space from table name)
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
