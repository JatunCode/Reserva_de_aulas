<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambiente', function (Blueprint $table) {
            $table->uuid('ID_AMBIENTE')->primary()->unique();
            $table->string('TIPO', 10)->nullable(false);
            $table->string('NOMBRE', 50)->nullable(false);
            $table->json('REFERENCIAS');
            $table->integer('CAPACIDAD')->nullable(false);
            $table->enum('DATA', ['SI', 'NO'])->nullable(false);
            $table->enum('ESTADO',['HABILITADO', 'NO HABILITADO'])->nullable(false);
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
        Schema::dropIfExists('ambiente');
    }
}




