<?php

namespace App\Models\admin\donations;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\donations\DonationCategory;

class DonationCase extends Model
{
    protected $table = 'donation_cases';

    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'image',
        'donation_required',
        'donation_raised',
        'target_days',
        'supports_count',
        'category_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(DonationCategory::class, 'category_id');
    }
}
