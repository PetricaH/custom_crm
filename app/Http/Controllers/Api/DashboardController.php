<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Invoice;
use App\Models\Interaction;
use App\Models\SalesAgent;

class DashboardController extends Controller
{
    // 📌 1️⃣ Get the overall CRM summary (Dashboard Overview)
    public function getSummary()
    {
        return response()->json([
            'totalClients' => Client::count(),
            'totalSales' => Sale::sum('amount'),
            'pendingInvoices' => Invoice::where('status', 'pending')->count(),
            'completedTransactions' => Invoice::where('status', 'paid')->count(),
            'totalInteractions' => Interaction::count(),
            'totalRevenue' => Invoice::sum('amount'),
            'averageSalesCycle' => Sale::avg('sales_cycle_days'),
            'salesByAgent' => SalesAgent::withSum('sales', 'amount')->get(['id', 'name'])
        ]);
    }

    // 📌 2️⃣ Get the monthly invoice data (Paid vs Unpaid)
    public function invoicesPerMonth()
    {
        $invoices = Invoice::selectRaw("YEAR(created_at) as year, MONTH(created_at) as month, status, SUM(amount) as total")
            ->groupBy('year', 'month', 'status')
            ->get()
            ->groupBy(['year', 'month']);

        $formatted = [];
        foreach ($invoices as $year => $months) {
            foreach ($months as $month => $statuses) {
                $formatted[] = [
                    'year' => $year,
                    'month' => $month,
                    'paid' => $statuses->where('status', 'paid')->sum('total'),
                    'unpaid' => $statuses->where('status', 'pending')->sum('total'),
                ];
            }
        }

        return response()->json($formatted);
    }

    // 📌 3️⃣ Get Sales Data (For Sales Table)
    public function salesData()
    {
        $sales = Sale::with('salesAgent')->get();

        $formatted = $sales->map(function ($sale) {
            return [
                'vanzator' => $sale->salesAgent->name ?? 'Unknown',
                'interactiuni' => $sale->interactions_count,
                'ciclu_vanzare' => $sale->sales_cycle_days,
                'facturat' => $sale->amount,
                'clienti_contactati' => $sale->clients_contacted,
                'nr_vanzari' => $sale->sales_count,
                'evolutie' => $sale->growth_percentage
            ];
        });

        return response()->json($formatted);
    }

    // 📌 4️⃣ Get Invoiced Amount by Domain (For Domain Chart)
    public function domainInvoices(Request $request)
    {
        $query = Invoice::query();

        // Apply filters (optional)
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        if ($request->has('sales_agent')) {
            $query->where('sales_agent_id', $request->sales_agent);
        }

        // Aggregate invoice amounts per domain
        $domainInvoices = $query->selectRaw("domain, SUM(amount) as total")
            ->groupBy('domain')
            ->get();

        return response()->json($domainInvoices);
    }
}
