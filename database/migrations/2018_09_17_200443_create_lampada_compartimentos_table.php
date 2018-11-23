<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLampadaCompartimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lampada_compartimentos', function (Blueprint $table) {
             $table->integer('id_lampada')->unsigned();
             $table->integer('id_compartimento')->unsigned();
             $table->integer('quantidade')->nullable()->unsigned();
             $table->foreign('id_lampada')->references('id')->on('lampadas') ->onDelete('cascade');
             $table->foreign('id_compartimento')->references('id')->on('compartimentos') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lampada_compartimentos');
    }
}
