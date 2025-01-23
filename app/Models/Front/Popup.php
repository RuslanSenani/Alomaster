<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $table = 'popups';
    protected $fillable = ['title', 'description', 'page', 'isActive',];
}
