<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalesAgentIdToInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Add the column as unsignedBigInteger (adjust based on your users table primary key type)
            $table->unsignedBigInteger('sales_agent_id')->nullable();
            $table->foreign('sales_agent_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['sales_agent_id']);
            $table->dropColumn('sales_agent_id');
        });
    }
}
