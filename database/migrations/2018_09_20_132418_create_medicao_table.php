<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_consumo')->unsigned();
            $table->integer('id_medidor')->unsigned()->nullable();
            $table->foreign('id_medidor')->references('id')->on('medidors') ->onDelete('cascade');
            $table->foreign('id_consumo')->references('id')->on('consumos') ->onDelete('cascade');

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
        Schema::table('medicaos', function (Blueprint $table) {
            //
        });
    }
}
