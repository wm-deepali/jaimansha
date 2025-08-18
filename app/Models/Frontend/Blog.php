<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\Frontend\BlogCategory;

class Blog extends Model
{
     protected $table = 'blog_contents';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'detail_content',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
    ];

      public $timestamps=false;
    /**
     * Get the category this blog belongs to.
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
