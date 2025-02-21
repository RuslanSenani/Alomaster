<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = ['url', 'title', 'gallery_type', 'folder_name', 'rank', 'isActive',];

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function video(): HasMany
    {
        return $this->hasMany(Video::class);
    }



}
