<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class CoScholastic extends Model
{
    protected $table = 'co_scholastics';
    protected $fillable = ['scholastic_id', 'title', 'content']; // adjust as per table
    public $timestamps = false;

    public function scholastic()
    {
        return $this->belongsTo(Scholastic::class, 'id', 'id');
    }
}
