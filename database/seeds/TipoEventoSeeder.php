<?php

use Illuminate\Database\Seeder;

class TipoEventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoeventos')->insert(['descricao' => "Auditoria",'cor'=>'bg-green']);
        DB::table('tipoeventos')->insert(['descricao' => "Visita",'cor'=>'bg-yellow']);
        DB::table('tipoeventos')->insert(['descricao' => "Reunião",'cor'=>'bg-aqua']);
    }
}

?>
