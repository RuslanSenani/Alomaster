<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';
    protected $fillable = ['url', 'title', 'description', 'img_url', 'rank', 'isActive',];
}
