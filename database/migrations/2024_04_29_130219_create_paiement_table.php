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

        Schema::create('paiement', function (Blueprint $table) {
            $table->increments('pai_id');
            $table->string('pai_statut');
            $table->string('pai_mode');
            $table->double('pai_montant');
            $table->date('pai_date');

            // ajouter un index sur la colonne pai_id
            $table->index('pai_id');
            $table->timestamps();

        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement');
    }
};
