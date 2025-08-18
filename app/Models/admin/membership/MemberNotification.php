<?php

namespace App\Models\admin\membership;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\membership\MembershipPage;

class MemberNotification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'membership_id',
        'title',
        'description'
    ];

    public function membership()
    {
        return $this->belongsTo(MembershipPage::class, 'membership_id');
    }
}
