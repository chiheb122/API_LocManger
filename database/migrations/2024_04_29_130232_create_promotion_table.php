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

        Schema::create('promotion', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_nom');
            $table->double('pro_pourcentage');
            $table->date('pro_dateDebut');
            $table->date('pro_dateFin');
            $table->unsignedInteger('fk_pro_locId');
            $table->foreign('fk_pro_locId')->references('loc_id')->on('location')->onDelete('cascade');
            // ajouter le timestamp
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion');
    }
};
