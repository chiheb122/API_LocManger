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

        Schema::create('client', function (Blueprint $table) {
            $table->increments('cli_id')->cascadeOnDelete();
            $table->string('cli_nom');
            $table->string('cli_prenom');
            $table->integer('cli_note')-> default(0);
            $table->integer('cli_tel');
            $table->string('cli_adresse');
            $table->string('cli_ville');
            $table->String('cli_pays');
            $table->String('cli_codePostal');
            // Ajouter la clé étrangère après la création de la table 'client'

            // ajouter un index sur la colonne cli_id
            $table->index('cli_id');
            $table->timestamps();


        });
        Schema::table('users', function (Blueprint $table) {
        $table->foreign('Fk_cli_id')->references('cli_id')->on('client')->onDelete('cascade');
    });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
