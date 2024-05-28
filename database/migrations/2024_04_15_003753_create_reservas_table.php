<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->uuid('ID_RESERVA')->primary()->unique();
            $table->foreignUuid('ID_SOLICITUD')->constrained('solicitud','ID_SOLICITUD'); //procedural store
            $table->json('RAZONES');
            $table->dateTime('FECHAHORA_RESER'); //procedural stores
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
        Schema::dropIfExists('reserva');
    }
}
