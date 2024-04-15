<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud', function (Blueprint $table) {
            $table->uuid('ID_SOLICITUD')->primary()->unique();
            $table->json('ID_DOCENTE_s')->nullable(false);
            $table->integer('CANTIDAD_EST')->nullable(false);
            $table->date('FECHA_RE');
            $table->time('HORAINI'); //Hora en que comienza el evento
            $table->time('HORAFIN'); //Hora en que termina el evento
            $table->dateTime('FECHAHORA_SOLI'); //hora en que llego la solicitud
            $table->string('MOTIVO', 200);
            $table->json('PRIORIDAD'); //mostrara si es URGENTE => RAZONES sino NO URGENTE => sin razones
            $table->foreignId('ID_MATERIA')->constrained('materia','ID_MATERIA'); //procedural store
            $table->json('GRUPOS'); //procedural store
            $table->foreignUuid('ID_AMBIENTE')->constrained('ambiente','ID_AMBIENTE');
            $table->enum('ESTADO', ['CANCELADO', 'RESERVADO', 'SOLICITADO']);
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
        Schema::dropIfExists('solicitud');
    }
}



