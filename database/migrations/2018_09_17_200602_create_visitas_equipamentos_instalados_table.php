<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasEquipamentosInstaladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas_equipamentos_instalcao', function (Blueprint $table) {
            $table->integer('id_equipamento')->unsigned();
             $table->integer('id_visitas')->unsigned();
              $table->string('obs');
             $table->foreign('id_equipamento')->references('id')->on('equipamentos_instalcao') ->onDelete('cascade');
             $table->foreign('id_visitas')->references('id')->on('visitas') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas_equipamentos_instalados');
    }
}
