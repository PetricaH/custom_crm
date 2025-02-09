<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Assuming sales agents are users.
use Illuminate\Http\Request;

class SalesAgentController extends Controller
{
    public function index()
    {
        // Assuming you are using Spatie's package and your sales agents have the role "sales_agent".
        $salesAgents = User::role('sales_agent')->get();

        return response()->json($salesAgents);
    }
}
