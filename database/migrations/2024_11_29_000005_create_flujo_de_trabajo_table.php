<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlujoDeTrabajoTable extends Migration
{
    public function up()
    {
        Schema::create('flujo_de_trabajo', function (Blueprint $table) {
            $table->id('idFlujoDeTrabajo');
            $table->string('nombre');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flujo_de_trabajo');
    }
}

