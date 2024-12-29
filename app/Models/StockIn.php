<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Termwind\parse;

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


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('excludeDeleted', function ($builder) {
            $builder->whereHas('product', function ($query) {
                $query->whereNull('deleted_at');
            })->whereHas('warehouse', function ($query) {
                $query->whereNull('deleted_at');
            })->whereHas('category', function ($query) {
                $query->whereNull('deleted_at');
            })->whereHas('model', function ($query) {
                $query->whereNull('deleted_at');
            })->whereHas('supplier', function ($query) {
                $query->whereNull('deleted_at');
            });
        });

    }

    public
    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withDefault([
            'product_name' => 'Məhsul Silinib'
        ]);
    }

    public
    function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class)->withDefault([
            'name' => 'Anbar Silinib',
        ]);
    }

    public
    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Kateqoriya Silinib',
        ]);
    }

    public
    function model(): BelongsTo
    {
        return $this->belongsTo(DbModel::class)->withDefault([
            'name' => 'Model Silinib',
        ]);
    }

    public
    function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class)->withDefault([
            'name' => 'Tədarükçü Silinib',
        ]);
    }

    public
    function StockOut(): HasMany
    {
        return $this->hasMany(StockOut::class);
    }


}
