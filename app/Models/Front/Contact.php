<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['ip','name', 'phone', 'email', 'subject','message'];
}
