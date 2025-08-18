<?php

namespace App\Models\admin\contact;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
        protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'services',
        'message'
    ];

    public $timestamps=false;
}
