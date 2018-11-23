<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert(['name' => "Heleno Sanches",'email' => 'admin_repower@repower.cv','password' => bcrypt('admin2014rep*'),'idTipo' =>1,'img_path'=>'img/alt_pic.jpg','estado'=>1,'canlog'=>1]);
    }
}

?>
