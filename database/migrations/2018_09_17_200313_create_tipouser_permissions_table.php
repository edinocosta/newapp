<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipouserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipouser_permissions', function (Blueprint $table) {
            $table->integer('idTipoUsers')->unsigned();
             $table->integer('idPermission')->unsigned();
             $table->foreign('idTipoUsers')->references('id')->on('tipousers') ->onDelete('cascade');
             $table->foreign('idPermission')->references('id_permission')->on('permissions') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipouser_permissions');
    }
}
