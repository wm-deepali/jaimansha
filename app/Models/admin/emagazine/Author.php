<?php

namespace App\Models\admin\emagazine;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors'; // ✅ Updated table name

    protected $fillable = [
        'name',
        'image',
        'mobile_number',
        'father_name',
        'email',
        'whatsapp_number',
        'address',
        'country',
        'state',
        'city',
        'pin_code',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'pdf',
        'author_type',
        'registered_by',
        'status',
        'created_at',
        'updated_at'
    ];

    public $timestamps=false;
}
