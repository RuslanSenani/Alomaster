<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    protected $table = 'videos';
    protected $fillable = ['gallery_id', 'url', 'rank', 'isActive',];

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
