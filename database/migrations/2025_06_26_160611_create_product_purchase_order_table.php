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
        Schema::create('product_purchase_order', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('purchase_order_id');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_purchase_order');
    }
};
