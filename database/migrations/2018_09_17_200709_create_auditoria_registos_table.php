<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriaRegistosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_registos', function (Blueprint $table) {
            $table->integer('idRegisto')->unsigned();
             $table->integer('idAuditoria')->unsigned();
             $table->foreign('idAuditoria')->references('id')->on('auditorias') ->onDelete('cascade');
             $table->foreign('idRegisto')->references('id')->on('registos') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditoria_registos');
    }
}
