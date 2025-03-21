<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;


    protected $table = 'customers';
    protected $fillable = [
        'name',
        'code',
        'email',
        'phone'
    ];

    public function StockOut(): HasMany
    {
        return $this->hasMany(StockOut::class);
    }
}
