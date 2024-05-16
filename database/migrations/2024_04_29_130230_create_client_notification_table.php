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
        Schema::disableForeignKeyConstraints();

        Schema::create('client_notification', function (Blueprint $table) {
            $table->unsignedInteger('CN_cli_id');
            $table->foreign('CN_cli_id')->references('cli_id')->on('client');
            $table->unsignedInteger('CN_not_id');
            $table->foreign('CN_not_id')->references('not_id')->on('notification');
            $table->timestamps();

        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_notification');
    }
};
