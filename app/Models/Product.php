<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'cost', 'sale_price', 'barcode',
    ];

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
