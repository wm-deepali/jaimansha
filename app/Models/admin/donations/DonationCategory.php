<?php

namespace App\Models\admin\donations;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\donations\DonationCase;

class DonationCategory extends Model
{
    protected $table = 'donation_categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function cases()
    {
        return $this->hasMany(DonationCase::class, 'category_id');
    }
}
