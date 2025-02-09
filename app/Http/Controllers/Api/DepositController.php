<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        return response()->json(Deposit::all());
    }

    public function store(Request $request)
    {
        $deposit = Deposit::create($request->all());
        return response()->json($deposit, 201);
    }

    public function show(Deposit $deposit)
    {
        return response()->json($deposit);
    }

    public function update(Request $request, Deposit $deposit)
    {
        $deposit->update($request->all());
        return response()->json($deposit);
    }

    public function destroy(Deposit $deposit)
    {
        $deposit->delete();
        return response()->json(null, 204);
    }
}
