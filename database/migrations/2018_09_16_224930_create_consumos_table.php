<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumos', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_compartimento')->unsigned();
            $table->foreign('id_compartimento')->references('id')->on('compartimentos') ->onDelete('cascade');
            $table->integer('id_auditoria')->unsigned();
            $table->foreign('id_auditoria')->references('id')->on('auditorias') ->onDelete('cascade');
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
        Schema::dropIfExists('consumos');
    }
}
