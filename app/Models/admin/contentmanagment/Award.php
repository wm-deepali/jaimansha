<?php

namespace App\Models\admin\contentmanagment;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    // Table name agar model name se alag ho to specify karo
    protected $table = 'awards_certification';

    // Fillable fields for mass assignment
    protected $fillable = [
        'heading_1',
        'heading_2',
        'title',
        'description',
        'image'
    ];

    // Agar tum created_at, updated_at ko manage karna chahte ho to default true hi rakho
    public $timestamps = false;
}
