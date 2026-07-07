<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name');
            $table->string('invoice_no')->unique();
            $table->string('date');
            $table->string('name')->nullable();
            $table->integer('mobile_nu')->nullable();
            $table->string('items');
            $table->decimal('price', 10, 2);
            $table->integer('qty');
            $table->decimal('total', 10, 2);
            $table->string('note')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('gst', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('gtotal', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
