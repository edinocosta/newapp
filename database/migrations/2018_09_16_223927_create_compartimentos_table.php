<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompartimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compartimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_propriedade')->unsigned();
            $table->string('nome')->nullable();
            $table->string('piso')->nullable();
            $table->double('comprimento')->nullable();
            $table->double('largura')->nullable();
            $table->double('pe_direito')->nullable();
            $table->foreign('id_propriedade')->references('id')->on('propriedades') ->onDelete('cascade');
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
        Schema::dropIfExists('compartimentos');
    }
}
