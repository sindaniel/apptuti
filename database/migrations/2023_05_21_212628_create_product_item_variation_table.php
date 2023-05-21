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
        Schema::create('product_item_variation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variation_item_id');
            $table->unsignedBigInteger('product_id');
             
            $table->decimal('price', 10, 2);
            $table->boolean('enabled')->default(true);
            $table->timestamps();


            $table->foreign('variation_item_id')->references('id')->on('variation_items')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_item_variation');
    }
};
