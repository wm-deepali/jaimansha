<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    protected $fillable = ['title', 'pdf_file', 'status'];
}
