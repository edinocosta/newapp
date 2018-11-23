<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTipo')->unsigned();
            $table->string('name');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('img_path')->nullable();
            $table->boolean('canlog')->nullable();
            $table->boolean('estado')->nullable();
            $table->foreign('idTipo')->references('id')->on('tipousers') ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
