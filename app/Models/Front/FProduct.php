<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FProduct extends Model
{
    protected $table = 'f_products';
    protected $fillable = ['url', 'title', 'description', 'rank', 'isActive'];

    public function image(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
