<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_agent_id')->constrained('sales_agents')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->integer('sales_cycle_days');
            $table->integer('clients_contacted')->default(0);
            $table->integer('sales_count')->default(0);
            $table->decimal('growth_percentage', 5, 2)->default(0.00);
            $table->timestamps();
        });
    }
   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
