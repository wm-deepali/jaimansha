<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $table = 'sponsorships';

    protected $fillable = [
        'title1',
        'title2',
        'title3',
        'title4',
        'short_description1',
        'short_description2',
        'short_description3',
        'sponsorship_type',
        'status',
    ];

    public $timestamps = false;
}
