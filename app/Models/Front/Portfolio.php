<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    protected $table = 'portfolios';
    protected $fillable = ['category_id', 'url', 'portfolio_url', 'title', 'description', 'client', 'place', 'rank', 'isActive', 'finishedAt',];


    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }

    public function portfolioImage(): HasMany
    {
        return $this->hasMany(PortfolioImage::class, 'portfolio_id');
    }
}
