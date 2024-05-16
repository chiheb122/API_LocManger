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
            $table->integer('loc_equ_id'); // si
            $table->string('loc_EtatEquipement');
            $table->integer('Fk_loc_paie')->unsigned(); // Assurez-vous que Fk_loc_paie est unsigned
            $table->foreign('Fk_loc_paie')->references('pai_id')->on('paiement');
            $table->integer('Fk_loc_cli')->unsigned(); // Assurez-vous que Fk_loc_cli est unsigned
            $table->foreign('Fk_loc_cli')->references('cli_id')->on('client');
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
