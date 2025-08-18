<?php

namespace App\Models\admin\setting;

use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    // 🔹 Explicitly set table name (if different from model name)
    protected $table = 'authentication';

    // 🔹 Primary key (if not 'id')
    protected $primaryKey = 'id';

    // 🔹 If you don't want Laravel to auto-manage created_at/updated_at
    public $timestamps = false;

    // 🔹 Fields that are mass assignable
    protected $fillable = [
        'username',
        'password',
        'status',
        'admin_added',
    ];
}
