<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class HeaderInformation extends Model
{
    // Table name explicitly defined
    protected $table = 'header_information';
       protected $fillable = [
        'mobileNumber',
        'helplineNumber',
        'email',
        'logo',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'gplus',
        'pintreset' ,
        'added_date',
    ];
  public $timestamps = false;
}
