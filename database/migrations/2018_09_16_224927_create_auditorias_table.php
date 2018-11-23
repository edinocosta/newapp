<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_propriedade')->unsigned();
            $table->integer('c_inicio')->nullable();
            $table->integer('c_fim')->nullable();
            $table->string('descricao')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('file_exel_path')->nullable();
            $table->date('data_inicio');
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
        Schema::dropIfExists('auditorias');
    }
}
