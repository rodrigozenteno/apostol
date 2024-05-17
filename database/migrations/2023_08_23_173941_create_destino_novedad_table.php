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
        Schema::create('destino_novedad', function (Blueprint $table) {
            $table->id();
            $table->date('desde');
            $table->date('hasta')->nullable();
            $table->string('obs', 2048)->nullable();//1=ACTUAL, 2=ANTERIOR

            $table->foreignId('destino_id')->constrained('destinos');
            $table->foreignId('novedad_id')->constrained('novedads');
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
        Schema::dropIfExists('destino_novedad');
    }
};
