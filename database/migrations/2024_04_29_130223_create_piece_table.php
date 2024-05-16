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

        Schema::create('piece', function (Blueprint $table) {
            $table->increments('pie_id');
            $table->string('pie_nom');
            $table->integer('pie_quantite');
            $table->double('pie_prix');
            $table->String('pie_reference');
            $table->date('pie_dateEntree');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece');
    }
};
