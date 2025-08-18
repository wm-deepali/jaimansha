<?php

namespace App\Models\admin\ManageIntroduction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntroductionFeature extends Model
{
    use HasFactory;

    protected $table = 'introduction_features';

    protected $fillable = [
        'introduction_id',
        'feature_title',
        'feature_content',
        'icon',
    ];

    // 📌 Belongs to Introduction
    public function introduction()
    {
        return $this->belongsTo(Introduction::class, 'introduction_id');
    }
}
