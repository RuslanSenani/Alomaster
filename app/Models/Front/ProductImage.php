<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = ['product_id', 'img_url', 'rank', 'isActive', 'isCover'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(FProduct::class,'product_idl');
    }

}
