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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ci', 9)->unique();
            $table->string('comp', 10)->nullable();
            $table->string('ext', 4);
            $table->string('papeleta', 9)->unique();
            $table->string('prim_nombre', 30);
            $table->string('seg_nombre', 30);
            $table->string('prim_apellido', 30);
            $table->string('seg_apellido', 30);
            $table->date('f_nac');
            $table->string('sexo', 30);
            $table->string('g_sang', 10);
            $table->string('e_civil', 20);
            $table->integer('ant');
            $table->date('f_alt');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
