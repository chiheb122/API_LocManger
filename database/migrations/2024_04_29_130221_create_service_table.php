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

        Schema::create('service', function (Blueprint $table) {
            $table->increments('ser_id');
            $table->unsignedInteger('cli_id');
            $table->foreign('cli_id')->references('cli_id')->on('client')->onDelete('cascade');
            $table->string('ser_type');
            $table->double('ser_cout');
            $table->string('ser_statuts');
            $table->unsignedInteger('ser_empId'); // Changer le type de données en unsignedInteger
            $table->foreign('ser_empId')->references('emp_id')->on('employe');
            $table->date('ser_dateDebut');
            $table->date('ser_dateFin');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};
