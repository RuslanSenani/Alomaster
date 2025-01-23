<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = ['url', 'title', 'description', 'img_url', 'rank', 'isActive',];
}
