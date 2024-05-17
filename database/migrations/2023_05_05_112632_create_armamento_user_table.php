<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armamento_user', function (Blueprint $table) {
            $table->id();

            $table->integer('tipo');
            $table->string('serie', 20)->nullable();
            $table->integer('dotacion');
            $table->integer('cargador')->nullable();
            $table->string('accesorios')->nullable();
            $table->string('uso', 150)->nullable();
            $table->string('novedades');

            $table->foreignId('modelo_id')->constrained('modelos');
            $table->foreignId('situacion_id')->constrained('situacions');
            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('armamento_user');
    }
};
