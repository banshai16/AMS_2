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
        Schema::create('network', function (Blueprint $table) {
            $table->id();
            $table->string('dept_name');
            $table->string('address');
            $table->string('dept_nodal_person');
            $table->string('bandwidth');
            $table->string('link_type');
            $table->date('date_of_commissioning');
            $table->string('longitude')->unique();
            $table->string('latitude')->unique();
            $table->string('no_of_segments');
            $table->string('vlan_id');
            $table->string('no_of_ip');
            $table->string('ip_range');
            $table->string('router_model');
            $table->string('ownership_of_router');
            $table->string('lease_line_provider');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network');
    }
};
