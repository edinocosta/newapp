<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->string('marca')->nullable();
            $table->string('nome')->nullable();
            $table->string('modelo');
            $table->integer('id_categoria')->unsigned()->nullable();   
            $table->increments('id');
            $table->double('consumo')->nullable();
            $table->double('corrente')->nullable();
            $table->double('frequencia')->nullable();
            $table->string('alimentacao')->nullable();
            $table->double('tensao')->nullable();
            $table->double('potencia')->nullable();
            $table->double('serie')->nullable();
            $table->foreign('id_categoria')->references('id')->on('categorias') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipamentos');
    }
}
