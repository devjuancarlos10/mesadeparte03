<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id('idExpediente');
            $table->string('tipo');
            $table->string('apellidos')->nullable();
            $table->boolean('conPago');
            $table->string('archivoDePago')->nullable();
            $table->string('dependencia')->nullable();
            $table->string('asunto');
            $table->string('firma')->nullable();
            $table->string('correoElectronico');
            $table->integer('numeroFolios')->nullable();
            $table->string('archivoExpediente')->nullable();
            $table->foreignId('usuarioSolicitante')->constrained('usuarios', 'idUsuario');
            $table->foreignId('flujoTrabajo')->constrained('flujo_de_trabajo', 'idFlujoDeTrabajo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
}

