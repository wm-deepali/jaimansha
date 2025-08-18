<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\emagazine\Author; // Correct namespace
use App\Models\admin\emagazine\Category; // Only if needed

class EMagazine extends Model
{
    protected $table = 'publications'; // Database table name

    protected $fillable = [
        'author_id',
        'title',
        'description',
        'registered_by',
        'status',
        'author_type', // Agar column table me hai to include karo
    ];

    /**
     * Relationship with Author
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    /**
     * Relationship with Category (optional)
     */
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }

    public $timestamps=true;
}
