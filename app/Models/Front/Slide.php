<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slides';
    protected $fillable = ['title', 'description', 'allowButton', 'button_url', 'button_caption', 'animation_type', 'animation_time', 'rank', 'isActive','img_url'];
}
