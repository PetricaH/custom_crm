<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAgent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    // Relationship: A SalesAgent has many Sales
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
