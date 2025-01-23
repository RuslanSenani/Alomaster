<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $fillable = ['email', 'phone', 'isActive',];
}
