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
        Schema::table('marketplace_sellers', function (Blueprint $table) {
            $table->enum('regime', ['Régimen simple', 'Común', 'Gran contribuyente'])->nullable();
            $table->string('citizenship_card')->nullable();
            $table->string('rut')->nullable();
            $table->string('bank_certification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketplace_sellers', function (Blueprint $table) {
            $table->dropColumn(['regimen', 'cedula_ciudadania', 'rut', 'certificacion_bancaria']);
        });
    }
};
