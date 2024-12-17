<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockOut extends Model
{

    use SoftDeletes;
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public  function  customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function stockIn(): BelongsTo
    {
        return $this->belongsTo(StockIn::class);
    }
}
