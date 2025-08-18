<?php

namespace App\Models\Admin\ManageIntroduction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Introduction extends Model
{
    use HasFactory;

    protected $table = 'introductions';

    protected $fillable = [
        'heading',
        'detail_content',
    ];

    // 📌 Relation to features
    public function features()
    {
        return $this->hasMany(IntroductionFeature::class, 'introduction_id');
    }
}
