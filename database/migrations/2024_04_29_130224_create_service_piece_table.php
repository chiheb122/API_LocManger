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

        Schema::create('service_piece', function (Blueprint $table) {
            $table->increments('SP_serid');
            $table->unsignedInteger('SP_pieid');
            $table->foreign('SP_serid')->references('ser_id')->on('service')->onDelete('cascade');
            $table->foreign('SP_pieid')->references('pie_id')->on('piece')->onDelete('cascade');
            $table->primary(['SP_serid', 'SP_pieid']);
            $table->timestamps();

        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_piece');
    }
};
