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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('sku');
            $table->string('slug');
            $table->boolean('active')->default(0);    
            $table->decimal('price', 10, 2);
            $table->integer('delivery_days');
            $table->integer('discount');
            $table->integer('quantity_min');
            $table->integer('quantity_max');
            $table->integer('step');

            //tax foreign key  
            $table->unsignedBigInteger('tax_id');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');

            $table->datetime('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('brand_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('brand_id');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_product');
        Schema::dropIfExists('products');
      
        
    }
};
