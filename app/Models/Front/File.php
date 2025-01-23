<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['gallery_id', 'url', 'rank', 'isActive',];

    public function gallery():BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
