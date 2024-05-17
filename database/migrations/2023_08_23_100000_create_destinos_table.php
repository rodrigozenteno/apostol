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
        Schema::create('destinos', function (Blueprint $table) {
            $table->id();
            $table->date('f_ini');
            $table->date('f_fin')->nullable();
            $table->string('estado', 1);//1=ACTUAL, 2=ANTERIOR

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('unidad_id')->constrained('unidads');
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
        Schema::dropIfExists('destinos');
    }
};
