<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        Schema::create('medidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMedicao')->unsigned();
            $table->double('energia')->nullable();
            $table->double('pot_max')->nullable();
            $table->double('pot_min')->nullable();
            $table->string('tmp_ligado')->nullable();
            $table->string('hora_fim')->nullable();
            $table->string('hora_ini')->nullable();
            $table->date('data_ini')->nullable();
            $table->date('data_fim')->nullable();
            $table->double('contador_ini')->nullable();
            $table->double('contador_fim')->nullable();
            $table->integer('dia_ligado')->nullable();
             $table->foreign('idMedicao')->references('id')->on('medicaos') ->onDelete('cascade');
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
        Schema::dropIfExists('madidas');
    }
}
