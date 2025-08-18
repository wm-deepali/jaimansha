<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\contentmanagment\HeaderInformation;

class FooterInformation extends Model
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
        return $this->hasOne(HeaderInformation::class, 'email', 'email');
    }
}
