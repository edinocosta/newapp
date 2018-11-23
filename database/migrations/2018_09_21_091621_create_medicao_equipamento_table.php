<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicaoEquipamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicao_equipamento', function (Blueprint $table) {
             $table->integer('idMedicao')->unsigned();
             $table->integer('idEquipamento')->unsigned();
             $table->foreign('idMedicao')->references('id')->on('medicaos') ->onDelete('cascade');
             $table->foreign('idEquipamento')->references('id')->on('equipamentos') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicao_equipamento');
    }
}
