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
        Schema::table('network', function (Blueprint $table) {
            $table->decimal('latitude', 10,8)->unique();
            $table->decimal('longitude', 11,8)->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('network', function (Blueprint $table) {
            //
        });
    }
};
