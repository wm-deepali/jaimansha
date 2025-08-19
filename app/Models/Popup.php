<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = ['title', 'active'];

    public function images()
    {
        return $this->hasMany(PopupImage::class);
    }
}

