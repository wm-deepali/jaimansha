<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Frontend\Blog;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';

    protected $fillable = [
        'category_name',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
    ];

    public $timestamps=false;
    /**
     * Get all blog contents under this category.
     */
    public function blogContents(): HasMany
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
