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
        Schema::create('datosmilitars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('estado_id')->constrained('estados');
            $table->foreignId('escalafon_id')->constrained('escalafons');
            $table->foreignId('diplomado_id')->nullable()->constrained('diplomados');
            $table->foreignId('grado_id')->constrained('grados');
            $table->foreignId('arma_id')->nullable()->constrained('armas');
            $table->foreignId('profocup_id')->nullable()->constrained('profocups');
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
        Schema::dropIfExists('datosmilitars');
    }
};
