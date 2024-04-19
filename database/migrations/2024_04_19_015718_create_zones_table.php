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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('route')->nullable();
            $table->string('zone')->nullable();
            $table->string('day')->nullable();
            $table->string('address')->nullable();
            $table->string('code')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('zone_id')->nullable()->constrained('zones');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
        });





    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['zone_id']);
            $table->dropColumn('zone_id');
        });
        Schema::dropIfExists('zones');

    }
};
