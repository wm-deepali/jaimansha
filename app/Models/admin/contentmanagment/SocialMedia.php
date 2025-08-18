<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'header_information';
    public $timestamps = false;
    protected $fillable = [
        'facebook_link',
        'twitter_link',
        'linkedin_link',
        'youtube_link',
        'pinterest_link',
        'gplus_link', // optional
    ];
}
