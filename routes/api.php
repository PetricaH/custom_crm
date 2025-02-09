<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\InteractionController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DepositController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\TechnicalFileController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Api\SalesAgentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SalesAgentStatsController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::middleware('auth:sanctum')->group(function () {
    // Sales Agents Stats
    Route::get('/sales-agents-stats', [SalesAgentStatsController::class, 'index']);

    // Users
    Route::get('users', [UserController::class, 'index']);

    // Sales Agents
    Route::get('sales-agents', [SalesAgentController::class, 'index']);

    // Clients
    Route::apiResource('clients', ClientController::class);

    // Nested Interactions for a Client
    Route::apiResource('clients.interactions', InteractionController::class);

    // Products
    Route::apiResource('products', ProductController::class);

    // Deposits
    Route::apiResource('deposits', DepositController::class);

    // Invoices
    Route::apiResource('invoices', InvoiceController::class);

    // Technical Files
    Route::apiResource('technical-files', TechnicalFileController::class);

    // roles
    Route::get('/roles', [RoleController::class, 'index']);

    // 🔹 Dashboard API Routes (NEW)
    Route::get('/dashboard-summary', [DashboardController::class, 'getSummary']);
    Route::get('/invoices-per-month', [DashboardController::class, 'invoicesPerMonth']);
    Route::get('/sales-data', [DashboardController::class, 'salesData']);
    Route::get('/domain-invoices', [DashboardController::class, 'domainInvoices']);
});