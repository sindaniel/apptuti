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

        //users
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status_id')->default(0);
            $table->string('code')->nullable();
            $table->string('document')->nullable();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('document_front')->nullable();
            $table->string('document_back')->nullable();
            $table->string('company_document')->nullable();
            $table->boolean('has_whatsapp')->default(false);
            $table->boolean('visit_by_tronex')->default(false);
            $table->foreignId('state_id')->nullable()->constrained('states');
            $table->foreignId('city_id')->nullable()->constrained('cities');
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
