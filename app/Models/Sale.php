<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['sales_agent_id', 'amount', 'sales_cycle_days', 'clients_contacted', 'sales_count', 'growth_percentage'];

    // Define the relationship with SalesAgent
    public function salesAgent()
    {
        return $this->belongsTo(SalesAgent::class);
    }
}
