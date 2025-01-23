<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['url', 'title', 'description', 'img_url', 'event_date', 'rank', 'isActive',];
}
