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
        Schema::create('datos_complementarios', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->integer('cel');
            $table->string('contacto', 50);
            $table->integer('cel_contacto');
            $table->string('estado', 1);//1=ACTUAL, 2=ANTERIOR

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
        Schema::dropIfExists('datos_complementarios');
    }
};
