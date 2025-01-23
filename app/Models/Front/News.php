<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['url', 'title', 'description', 'news_type', 'img_url', 'video_url', 'rank', 'isActive',];
}
