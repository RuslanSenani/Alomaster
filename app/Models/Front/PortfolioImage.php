<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioImage extends Model
{
    protected $table = 'portfolio_images';
    protected $fillable = ['portfolio_id', 'img_url', 'rank', 'isActive',];

    public function portfolio():BelongsTo{
        return $this->belongsTo(Portfolio::class, 'portfolio_id');
    }
}
