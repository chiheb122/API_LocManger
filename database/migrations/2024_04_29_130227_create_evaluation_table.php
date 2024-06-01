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

        Schema::create('evaluation', function (Blueprint $table) {
            $table->increments('eva_id');
            $table->string('eva_commentaire');
            $table->unsignedInteger('FK_eva_cli_id');
            $table->foreign('FK_eva_cli_id')->references('cli_id')->on('client')->onDelete('cascade');
            $table->unsignedInteger('FK_equ_eva_id');
            $table->foreign('FK_equ_eva_id')->references('equ_id')->on('equipement')->onDelete('cascade');
            $table->timestamps();

        });

        Schema::table('equipement', function (Blueprint $table) {
            $table->index('equ_id');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation');
    }
};
