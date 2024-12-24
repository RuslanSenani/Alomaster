<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockOut extends Model
{

    protected $fillable = [
        'stock_in_id',
        'customer_id',
        'model_name',
        'barcode',
        'warehouse_name',
        'category_name',
        'product_name',
        'product_description',
        'product_img',
        'product_code',
        'qty',
        'product_unit',
        'product_unit_sale_price',
        'exit_date',
    ];



    use SoftDeletes;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function StockIn(): BelongsTo
    {
        return $this->belongsTo(StockIn::class);
    }
}
