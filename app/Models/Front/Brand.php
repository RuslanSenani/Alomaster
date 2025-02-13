<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = ['title', 'img_url', 'rank', 'isActive'];
}
