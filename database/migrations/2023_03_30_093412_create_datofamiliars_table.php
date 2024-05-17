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
        Schema::create('datofamiliars', function (Blueprint $table) {
            $table->id();

            $table->string('prim_apellido', 30);
            $table->string('seg_apellido', 30)->nullable();
            $table->string('nombres', 50);
            $table->string('c_seguro', 15)->nullable();

            $table->foreignId('relacion_id')->constrained('relacions');
            $table->foreignId('seguro_id')->nullable()->constrained('seguros');
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
        Schema::dropIfExists('datofamiliars');
    }
};
