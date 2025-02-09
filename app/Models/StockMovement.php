<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    // If you did not include timestamps in this table, you can disable them:
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'deposit_id', 'movement_type', 'quantity', 'reference', 'movement_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }
}
