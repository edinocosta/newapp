<?php

use Illuminate\Database\Seeder;

class EstadoAuditoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       DB::table('estadoauditorias')->insert(['descricao' => "Em Andamento"]);

       DB::table('estadoauditorias')->insert(['descricao' => "Suspenso"]);

       DB::table('estadoauditorias')->insert(['descricao' => "Cancelado"]);

       DB::table('estadoauditorias')->insert(['descricao' => "Concluido"]);
    }
}

?>
