<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class Objectives extends Model
{
    protected $table = 'objectives';

    protected $fillable = [
        'objective',
    ];

    public $timestamps = false;
}
