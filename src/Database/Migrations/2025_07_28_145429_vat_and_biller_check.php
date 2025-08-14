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
            $table->boolean('responsible_for_vat')->default(0);
            $table->boolean('electronic_biller')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('marketplace_sellers', function (Blueprint $table) {
            $table->dropColumn(['responsible_for_vat', 'electronic_biller']);
        });
    }
};
