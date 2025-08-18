<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'header_information';

    protected $fillable = [
        'logo',
        'mobile_number',
        'helplineNumber',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'gplus',
        'pintrest'
    ];

    public $timestamps = false;
}
