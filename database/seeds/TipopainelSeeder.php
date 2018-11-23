<?php

use Illuminate\Database\Seeder;

class TipopainelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipopainels')->insert(['descricao' => "Cristalino"]);
        DB::table('tipopainels')->insert(['descricao' => "Monocristalino"]);
        DB::table('tipopainels')->insert(['descricao' => "Poliristalino"]);
    }
}
?>