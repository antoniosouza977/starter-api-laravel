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
        Schema::create('role_restricted_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restricted_route_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('restricted_route_id')->references('id')->on('restricted_routes');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restricted_routes_role');
    }
};
