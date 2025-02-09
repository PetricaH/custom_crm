<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_id', 'total_amount', 'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
