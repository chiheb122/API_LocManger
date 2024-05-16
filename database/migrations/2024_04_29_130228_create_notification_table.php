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

        Schema::create('notification', function (Blueprint $table) {
            $table->increments('not_id');
            $table->string('not_message');
            $table->string('not_type');
            $table->integer('not_cli_id');
            $table->date('not_dateEnvoi');
            $table->string('not_sujet');
            $table->string('not_description');
            $table->timestamps();

        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
