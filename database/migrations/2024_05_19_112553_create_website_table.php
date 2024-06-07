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
        Schema::create('website', function (Blueprint $table) {
            $table->id();
            $table->string('developer');
            $table->string('dept_name');
            $table->string('owner');
            $table->string('manager_of_application');
            $table->text('description')->nullable();
            $table->string('hosting');
            $table->string('ip_address')->unique();
            $table->string('url')->unique();
            $table->string('platform');
            $table->boolean('ssl')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website');
    }
};
