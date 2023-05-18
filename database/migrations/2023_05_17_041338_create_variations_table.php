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
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('variation_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('variation_id');
            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('variation_items_id')->nullable();
            $table->unsignedBigInteger('product_id');


            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('variation_items_id')->references('id')->on('variation_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
