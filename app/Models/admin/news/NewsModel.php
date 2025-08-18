<?php

namespace App\Models\admin\news;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'news_title',
        'slug',
        'news_type',
        'detail_content',
        'pdf_file',
        'link_url',
        'meta_title',
        'meta_keywords',
        'meta_desc',
    ];

    public $timestamps=false;
}
