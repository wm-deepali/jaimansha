<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    // Table ka naam (optional agar naam default Laravel convention follow kare)
    protected $table = 'form_requests';

    // Mass assignment ke liye allowed columns
    protected $fillable = [
        'name',
        'email',
        'text',
    ];

    public $timestamps=false;
}
