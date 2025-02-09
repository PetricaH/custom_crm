<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('client_code')->nullable()->after('id');
            $table->unsignedBigInteger('salesperson_id')->nullable()->after('client_code');
            $table->foreign('salesperson_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['client_code', 'salesperson_id']);
        });
    }
};
