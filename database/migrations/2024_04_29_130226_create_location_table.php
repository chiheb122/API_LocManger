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

        Schema::create('location', function (Blueprint $table) {
            $table->increments('loc_id');
            $table->date('loc_DateDebut');
            $table->date('loc_DateFin');
            $table->double('loc_PrixTotal');
            $table->integer('Fk_loc_equ_id')->unsigned();
            $table->string('loc_EtatEquipement');
            $table->integer('Fk_loc_paie')->unsigned(); 
            $table->foreign('Fk_loc_paie')->references('pai_id')->on('paiement');
            $table->integer('Fk_loc_cli')->unsigned(); 
            $table->foreign('Fk_loc_cli')->references('cli_id')->on('client')->onDelete('cascade');
            $table->foreign('Fk_loc_equ_id')->references('equ_id')->on('equipement')->onDelete('cascade');
            $table->timestamps();


        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
