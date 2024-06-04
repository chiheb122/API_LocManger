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

        Schema::create('equipement', function (Blueprint $table) {
            $table->increments('equ_id');
            $table->string('equ_Description');
            $table->string('equ_Nom');
            $table->double('equ_PrixParJour');
            $table->integer('equ_StockDisponible');
            $table->string('equ_Catégorie');
            $table->string('equ_Image')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipement');
    }
};
