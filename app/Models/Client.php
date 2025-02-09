<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 
        'contact_info', 
        'additional_details',
        'salesperson_id',
    ];

    // Cast the contact_info column to an array
    protected $casts = [
        'contact_info' => 'array',
    ];

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
