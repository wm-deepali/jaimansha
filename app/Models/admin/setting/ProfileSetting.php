<?php

namespace App\Models\admin\setting;

use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    protected $table = 'authentication'; // 👈 ye batata hai ki ye model admins table ko use karega

    protected $fillable = [
        'full_name',
        'username',
        'password',
        'profile_picture',
        'contact_number',
        'address',
        'email_id',
        'logo_header',
        'login_logo',
        'status',
        'admin_added',
    ];

    public $timestamps=false;
}
