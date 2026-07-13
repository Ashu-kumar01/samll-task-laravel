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
            $table->date('date');

            $table->string('name')->nullable();
            $table->string('mobile_nu', 15)->nullable();

            $table->json('items');
            $table->json('price');
            $table->json('qty');
            $table->json('total');

            $table->text('note')->nullable();

            $table->decimal('subtotal', 10, 2);
            $table->decimal('gst', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('gTotal', 10, 2);

            $table->timestamps();
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
