<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'location', 'latitude', 'longitude',
    ];

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
