<?php

use Illuminate\Database\Seeder;

class TipoEI extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('tipoei')->insert(['descricao' => "Inversor"]);
         DB::table('tipoei')->insert(['descricao' => "Controlador"]);
         DB::table('tipoei')->insert(['descricao' => "Contador"]);
         DB::table('tipoei')->insert(['descricao' => "Bateria"]);
         DB::table('tipoei')->insert(['descricao' => "Painel Solar"]);
    }
}
?>
