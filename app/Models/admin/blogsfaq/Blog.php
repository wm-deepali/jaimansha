<?php

namespace App\Models\admin\blogsfaq;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'banner_image',          // ✅ Newly added
        'thumbnail_image',       // ✅ Newly added
        'status',
    ];

    public $timestamps = false;

    /**
     * Get the category this blog belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
