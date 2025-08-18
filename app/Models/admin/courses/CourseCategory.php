<?php

namespace App\Models\admin\courses;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'course_categories'; // ✅ Table name

    protected $fillable = [
        'category_name',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'image',
        'status'
    ];

    public $timestamps = false; // created_at and updated_at
}
