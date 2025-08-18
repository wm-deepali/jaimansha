<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footer_information';

    protected $fillable = [
        'address',
        'pincode',
        'email',
        'mobile',
        'copy_rights',
        'developer_company',
        'developer_url',
        'added_date',
    ];

    public $timestamps = false;

    // Relation using email
    public function header()
    {
        return $this->hasOne(Header::class, 'email', 'email');
    }
}
