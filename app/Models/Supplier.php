<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{

    use softDeletes;

    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'code',
        'email',
        'phone'
    ];

    public function StockIn(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }
}
