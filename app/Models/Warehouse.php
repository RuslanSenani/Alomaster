<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use softDeletes;

    protected $table = 'warehouses';
    protected $fillable = [
        'name',
        'location',
    ];


    public function StockIn(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }

    public function StockOut(): HasMany
    {
        return $this->hasMany(StockOut::class);
    }


}
