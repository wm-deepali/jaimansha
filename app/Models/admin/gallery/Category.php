<?php

namespace App\Models\admin\gallery;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'gallery_categories'; // Table name

    protected $fillable = [
        'category_name',
        'description',      // image/video (if required)
    ];

    public $timestamps = true; // created_at, updated_at

      public function media()
    {
        return $this->hasMany(Media::class, 'category_id');
    }
}
