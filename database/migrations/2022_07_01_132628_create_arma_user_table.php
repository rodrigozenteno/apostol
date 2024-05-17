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
        Schema::create('arma_user', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 1);//1=ACTUAL, 2=ANTERIOR
            $table->date('f_ini');
            $table->date('f_fin')->nullable();

            $table->foreignId('arma_id')->constrained('armas');
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
        Schema::dropIfExists('arma_user');
    }
};
