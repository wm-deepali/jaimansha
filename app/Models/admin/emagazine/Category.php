<?php

namespace App\Models\admin\emagazine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'author_id',
        'name',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'slug',
        'status',
    ];

    // Relationship with Author
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
