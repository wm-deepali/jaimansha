<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
        // Table name explicitly defined
    protected $table = 'about_sti';
       protected $fillable = [
         'heading_1',
         'heading_2',
         'Description',
         'image_1',
         'image_2',


    ];
  public $timestamps = false;
}
