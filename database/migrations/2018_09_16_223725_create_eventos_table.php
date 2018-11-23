<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTipo')->unsigned();
            $table->integer('idUser')->unsigned();
            $table->string('descricao')->nullable();
            $table->dateTime('inicio');
            $table->boolean('pub_private')->nullable();
            $table->string('backcolor')->nullable();
            $table->string('bordercolor')->nullable();
            $table->dateTime('fim')->nullable();
            $table->foreign('idUser')->references('id')->on('users') ->onDelete('cascade');
            $table->foreign('idTipo')->references('id')->on('tipoeventos') ->onDelete('cascade');
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
        Schema::dropIfExists('eventos');
    }
}
