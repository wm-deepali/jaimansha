<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletters';

    protected $fillable = [
        'email',
        'agree_terms',
    ];

    public $timestamps=false;
}
