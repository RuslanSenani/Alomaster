<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['company_name', 'about_us', 'address', 'mission', 'vision', 'logo', 'phone_1', 'phone_2', 'fax_1', 'fax_2', 'facebook', 'instagram', 'tik_tok', 'youtube', 'x', 'linkedin'];
}
