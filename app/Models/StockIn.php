<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockIn extends Model
{
    use softDeletes;

    protected $table = 'stock_ins';
    protected $fillable = [
        'warehouse_id',
        'product_id',
        'category_id',
        'model_id',
        'supplier_id',
        'product_img',
        'product_desc',
        'product_code',
        'qty',
        'remain_qty',
        'product_unit',
        'product_unit_price',
        'enter_date',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class)->withDefault([
            'name' => 'Anbar Silinib',
        ]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(DbModel::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function StockOut(): HasMany
    {
        return $this->hasMany(StockOut::class);
    }


}
