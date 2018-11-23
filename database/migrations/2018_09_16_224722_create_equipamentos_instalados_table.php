<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosInstaladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos_instalcao', function (Blueprint $table) {

            $table->increments('id');
            $table->double('potencia')->nullable();
            $table->double('t_entrada')->nullable();
            $table->double('t_saida')->nullable();
            $table->double('c_entrada')->nullable();
            $table->double('c_saida')->nullable();
            $table->double('dimensao')->nullable();
            $table->double('t_temperatura')->nullable();
            $table->double('p_entrada')->nullable();
            $table->double('eficencia')->nullable();
            $table->double('t_equalizacao')->nullable();
            $table->double('boost')->nullable();
            $table->double('float')->nullable();
            $table->double('capacidade')->nullable();
            $table->integer('celulas');
            $table->string('modelo');
            $table->string('marca');
            $table->integer('idTipo')->unsigned();
            $table->integer('idTipoP')->unsigned()->nullable();;
            $table->foreign('idTipoP')->references('id')->on('tipopainels') ->onDelete('cascade');            
            $table->integer('idTipoB')->unsigned()->nullable();;
            $table->foreign('idTipoB')->references('id')->on('tipobaterias') ->onDelete('cascade');
            $table->foreign('idTipo')->references('id')->on('tipoei') ->onDelete('cascade');
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
        Schema::dropIfExists('equipamentos_instalcao');
    }
}
