<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hora_fim')->nullable();
            $table->string('hora_ini')->nullable();
            $table->date('data_ini')->nullable();
            $table->date('data_fim')->nullable();
            $table->double('contador_ini')->nullable();
            $table->double('contador_fim')->nullable();
            $table->integer('id_compartimento')->unsigned();
            $table->foreign('id_compartimento')->references('id')->on('compartimentos') ->onDelete('cascade');

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
        Schema::dropIfExists('registos');
    }
}
