<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nombre1')->nullable();
            $table->string('nombre2')->nullable();
            $table->string('nombre3')->nullable();
            $table->string('nombre4')->nullable();
            $table->string('nombre5')->nullable();
            $table->string('materia')->nullable();
            $table->string('grupo');
            $table->integer('cantidad_estudiantes');
            $table->string('motivo');
            $table->string('modo');
            $table->string('razon')->nullable();
            $table->string('aula');
            $table->date('fecha');
            $table->string('horario');
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
        Schema::dropIfExists('solicitudes');
    }
}
