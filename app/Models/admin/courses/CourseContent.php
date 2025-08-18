<?php

namespace App\Models\admin\courses;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    protected $table = 'courses'; // ✅ Table name

    protected $fillable = [
        'course_name',
        'category_id',
        'duration',
        'course_fee',
        'discount_percentage',
        'discount_amount',
        'offered_price',
        'short_description',
        'course_detail',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'banner_image',
        'thumbnail_image',
        'status'
    ];

    public $timestamps = false;

    // ✅ Relation (optional)
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }
}
