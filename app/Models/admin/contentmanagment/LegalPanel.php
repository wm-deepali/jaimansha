<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class LegalPanel extends Model
{
     protected $table = 'legal_documents';

    protected $fillable = [
        'title',
        'image',
        'short_info',
        'status',
    ];

    public $timestamps = false;
}
