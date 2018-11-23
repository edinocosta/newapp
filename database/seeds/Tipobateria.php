<?php

use Illuminate\Database\Seeder;

class Tipobateria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipobaterias')->insert(['descricao' => "Gel"]);
        DB::table('tipobaterias')->insert(['descricao' => "Litio"]);
        DB::table('tipobaterias')->insert(['descricao' => "Ácido-Chumbo"]);

        DB::table('tipopainels')->insert(['descricao' => "Cristalino"]);
        DB::table('tipopainels')->insert(['descricao' => "Monocristalino"]);
        DB::table('tipopainels')->insert(['descricao' => "Poliristalino"]);
    }
}
?>