<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('deposit_id')->constrained()->onDelete('cascade');
            $table->enum('movement_type', ['in', 'out']);
            $table->integer('quantity');
            $table->string('reference')->nullable();
            $table->timestamp('movement_date')->useCurrent();
            // If you want an updated timestamp, uncomment the next line:
            // $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
