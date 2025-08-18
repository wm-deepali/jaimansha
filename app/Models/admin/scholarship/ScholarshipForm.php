<?php

namespace App\Models\admin\scholarship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipForm extends Model
{
      use HasFactory;

     protected $table='scholarships';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'eligibility',
        'benefits',
        'application_process',
        'document_required',
        'amount',
        'deadline',
        'category',
        'level',
        'contact_email',
        'official_website',
        'is_featured',
        'image',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status'
    ];

    public $timestamps=false;
}
