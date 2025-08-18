<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class ManagementCommittee extends Model
{
    protected $table = 'government_body';  // Table name

    protected $fillable = [
        'name',
        'designation',
        'member_category', // foreign key (from government_category)
        'image',
        'status',
    ];

    public $timestamps = false; // Since you're using `update_date` manually

    // Define relationship to GovernmentCategory
    public function category()
    {
        return $this->belongsTo(GovernmentCategory::class, 'member_category');
    }
}
