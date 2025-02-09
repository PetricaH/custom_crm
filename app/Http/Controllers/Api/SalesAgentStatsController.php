<?php
// app/Http/Controllers/Api/SalesAgentStatsController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SalesAgent;
use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesAgentStatsController extends Controller
{
    public function index(Request $request)
    {
        // For each sales agent, gather statistics.
        // This is a simple example; for performance, you might use joins or eager loading.
        $salesAgents = SalesAgent::all()->map(function ($agent) {
            // Assuming invoices table has a 'sales_agent_id' column
            $agent->total_invoices = Invoice::where('sales_agent_id', $agent->id)->count();
            $agent->total_invoice_amount = Invoice::where('sales_agent_id', $agent->id)->sum('amount');
            
            // Sales statistics from the sales table
            $agent->total_sales = Sale::where('sales_agent_id', $agent->id)->sum('amount');
            $agent->avg_sales_cycle = Sale::where('sales_agent_id', $agent->id)->avg('sales_cycle_days');

            // You could also add client-related stats if needed.
            return $agent;
        });

        return response()->json($salesAgents);
    }
}
