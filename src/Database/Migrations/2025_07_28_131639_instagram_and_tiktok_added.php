<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('marketplace_sellers', function (Blueprint $table) {
            $table->string('instagram')->default('');
            $table->string('tiktok')->nullable();
        });
    }

    public function down()
    {
        Schema::table('marketplace_sellers', function (Blueprint $table) {
            $table->dropColumn(['instagram', 'tiktok']);
        });
    }
};
