<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedidaMedicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medida_medicao', function (Blueprint $table) {
            
            $table->integer('idMedicao')->unsigned();
            $table->integer('idMedida')->unsigned();
            $table->foreign('idMedicao')->references('id')->on('medicaos') ->onDelete('cascade');
            $table->foreign('idMedida')->references('id')->on('medidas') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medida_medicao');
    }
}
