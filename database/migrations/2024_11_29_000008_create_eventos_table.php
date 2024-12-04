<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('idEstado');
            $table->string('descripcion');
            $table->string('tipoEvento');
            $table->foreignId('expediente')->constrained('expedientes', 'idExpediente');
            $table->timestamp('tiempoDelEvento');
            $table->string('estado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}

