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
        Schema::create('bonifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('buy');
            $table->integer('get');
            $table->timestamps();
        });


        Schema::create('bonification_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bonification_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('bonification_id')->references('id')->on('bonifications')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonification_product');
        Schema::dropIfExists('bonifications');
      
    }
};
