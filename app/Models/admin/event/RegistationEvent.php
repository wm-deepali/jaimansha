<?php

namespace App\Models\admin\event;

use Illuminate\Database\Eloquent\Model;

class RegistationEvent extends Model
{
    protected $table = 'event_registrations';

    protected $fillable = [
        'full_name',
        'email',
        'mobile',
        'event_id',
        'status',
    ];

    public $timestamps = false;

    // ✅ Relationship: One registration belongs to one event
    public function event()
    {
        return $this->belongsTo(EventManagement::class, 'event_id');
    }
}
