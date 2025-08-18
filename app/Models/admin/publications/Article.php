<?php

namespace App\Models\admin\publications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
      use HasFactory;

    protected $table = 'publications';

    protected $fillable = [
        'author_id',
        'title',
        'description',
        'registered_by',
        'status',
    ];

    // Author relationship
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

}
