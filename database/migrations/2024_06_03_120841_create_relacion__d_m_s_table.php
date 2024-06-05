<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionDMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_dm', function (Blueprint $table) {
            $table->uuid('ID_RELACION')->primary()->uniqid();
            $table->foreignUuid('ID_DOCENTE')->constrained('docente', 'ID_DOCENTE');
            $table->foreignId('ID_MATERIA')->constrained('materia', 'ID_MATERIA');
            $table->string('GRUPO', 5);
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
        Schema::dropIfExists('relacion__d_m_s');
    }
}
