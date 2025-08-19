<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupImage extends Model
{
    protected $fillable = ['popup_id', 'image_path'];

    public function popup()
    {
        return $this->belongsTo(Popup::class);
    }
}

