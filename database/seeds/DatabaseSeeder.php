<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    /* A Ordem Conta Muito */
   public function run()
{
		Model::unguard();
		$this->call('TipoUsersTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CategoriaSeeder');
		$this->call('EstadoAuditoriaSeeder');
		$this->call('PermissionSeeder');
		$this->call('Tipobateria');
		$this->call('TipoEI');
		//$this->call('TipopainelSeeder');
		Model::reguard();
		}
}

?>