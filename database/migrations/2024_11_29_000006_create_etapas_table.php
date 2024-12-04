<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtapasTable extends Migration
{
    public function up()
    {
        Schema::create('etapas', function (Blueprint $table) {
            $table->id('idEtapa');
            $table->string('nombreEtapa');
            $table->string('dependencia')->nullable();
            $table->integer('tiempoEstimado');
            $table->foreignId('responsable')->constrained('usuarios', 'idUsuario');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('etapas');
    }
}

