<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class GovernmentCategory extends Model
{
    protected $table = 'government_category';

    protected $fillable = [
        'member_category',
        'status',
        'added_date'
    ];

    public $timestamps = false;

    // Reverse relationship
    public function members()
    {
        return $this->hasMany(ManagementCommittee::class, 'member_category');
    }
}
