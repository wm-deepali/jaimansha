<?php

namespace App\Models\admin\emagazine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';

    protected $fillable = [
        'author_id',
        'title',
        'short_description',
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
