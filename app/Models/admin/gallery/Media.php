<?php

namespace App\Models\admin\gallery;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\gallery\Category;

class Media extends Model
{
    protected $table = 'gallery_media'; // Table name

    protected $fillable = [
        'title',         // Optional title of image or video
        'file_path',     // Image or video file path
        'media_type',    // image/video
        'category_id',   // Foreign key reference to gallery_categories
        'status',        // active/inactive
        'created_by',    // Admin or user who uploaded it
    ];

    public $timestamps = false;

    // Category relationship (many media belong to one category)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
