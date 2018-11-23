<?php

use Illuminate\Database\Seeder;

class TipoUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('tipousers')->insert(['descricao' => "Administrador"]);

       DB::table('tipousers')->insert(['descricao' => "Gestor"]);

       DB::table('tipousers')->insert(['descricao' => "Tecnico"]);

       DB::table('tipousers')->insert(['descricao' => "Estagiário"]);
    }
}
?>