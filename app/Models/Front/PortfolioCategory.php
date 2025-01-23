<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PortfolioCategory extends Model
{
    protected $table = 'portfolio_categories';
    protected $fillable = ['title', 'isActive'];

    public function portfolio():HasMany
    {
        return $this->hasMany(Portfolio::class,'category_id');
    }
}
