<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $fillable = ['title', 'description', 'full_name', 'company', 'img_url', 'rank', 'isActive'];
}
