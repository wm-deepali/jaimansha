<?php

namespace App\Models\admin\blogsfaq;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';

    protected $fillable = [
        'category_name',
        'slug',
        'written_by',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
        'image',
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
