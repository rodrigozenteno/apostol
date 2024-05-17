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
        Schema::create('unidads', function (Blueprint $table) {
            $table->id();
            
            $table->string('unidad', 100)->unique();
            $table->string('abrev', 50)->unique();

            $table->foreignId('municipio_id')->constrained('municipios');
            $table->foreignId('unidad_id')->nullable()->constrained('unidads');//ID DE LA UNIDAD SUPERIOR, PUEDE NO TENER
            $table->foreignId('ubicacion_id')->constrained('ubicacions');
            $table->foreignId('tipo_id')->constrained('tipos');
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
        Schema::dropIfExists('unidads');
    }
};
