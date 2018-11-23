<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriaConsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_consumo', function (Blueprint $table) {
            $table->integer('idConsumo')->unsigned();
             $table->integer('idAuditoria')->unsigned();
             $table->foreign('idAuditoria')->references('id')->on('auditorias') ->onDelete('cascade');
             $table->foreign('idConsumo')->references('id')->on('consumos') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditoria_consumo');
    }
}
