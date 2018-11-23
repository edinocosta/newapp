<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoeventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoeventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->string('backcolor')->nullable();
            $table->string('bordercolor')->nullable();
            $table->string('cor');
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoeventos');
    }
}
