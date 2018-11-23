<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteAuditoriaEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_estado', function (Blueprint $table) {
            $table->integer('idAuditoria')->unsigned();
             $table->integer('idEstado')->unsigned();
             $table->string('obs')->nullable();
             $table->foreign('idAuditoria')->references('id')->on('auditorias') ->onDelete('cascade');
             $table->foreign('idEstado')->references('id')->on('estadoauditorias') ->onDelete('cascade');
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
        Schema::dropIfExists('auditoria_estado');
    }
}
