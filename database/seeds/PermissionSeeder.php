<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(['nomePermissao' => 'Criar Auditora']);
        DB::table('permissions')->insert(['nomePermissao' => 'Adicionar Cliente']);
        DB::table('permissions')->insert(['nomePermissao' => 'Agendar Eventos']);
        DB::table('permissions')->insert(['nomePermissao' => 'Adicionar Equipamentos']);
        DB::table('permissions')->insert(['nomePermissao' => 'Adicionar Registo']);
    }
}
?>