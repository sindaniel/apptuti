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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('status_id')->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->timestamps();
        });

        
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('variation_id')->nullable()->constrained('variations');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->boolean('is_bonification')->default(false);
            $table->timestamps();
        });


        Schema::create('order_product_bonifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_product_id')->constrained('order_products');
            $table->foreignId('bonification_id')->constrained('bonifications');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_id')->constrained('orders');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_bonifications');
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('orders');
    }
};
