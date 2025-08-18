<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class Scholastic extends Model
{
    protected $table = 'scholastics';
    protected $fillable = ['title', 'content', 'status'];
    public $timestamps = false;

    public function coScholastics()
    {
        return $this->hasMany(CoScholastic::class, 'id', 'id');
    }
}
