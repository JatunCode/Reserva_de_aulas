<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionDAHMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_dahm', function (Blueprint $table) {
            $table->uuid('ID_RELACION')->primary()->unique();
            $table->foreignUuid('ID_DOCENTE')->constrained('docente', 'ID_DOCENTE');
            $table->foreignUuid('ID_AMBIENTE')->constrained('ambiente', 'ID_AMBIENTE');
            $table->foreignUuid('ID_HORARIO')->constrained('horario', 'ID_HORARIO');
            $table->foreignId('ID_MATERIA')->constrained('materia', 'ID_MATERIA');
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
        Schema::dropIfExists('relacion_dahm');
    }
}
