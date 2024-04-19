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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('company');
            $table->dropColumn('address');
            $table->dropColumn('area');
            $table->dropColumn('phone');
            $table->dropColumn('mobile');
            $table->dropColumn('document_front');
            $table->dropColumn('document_back');
            $table->dropColumn('company_document');
            $table->dropColumn('has_whatsapp');
            $table->dropColumn('visit_by_tronex');
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('route');
            $table->dropColumn('zone');
            $table->dropColumn('day');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('code')->nullable();
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
            $table->string('route')->nullable();
            $table->integer('zone')->nullable();
            $table->integer('day')->nullable();
        });
    }
};
