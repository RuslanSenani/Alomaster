<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DbModel extends Model
{
    use SoftDeletes;

    protected $table = "db_models";

    protected $fillable = [
        'name'
    ];

    public function StockIn(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }
}
