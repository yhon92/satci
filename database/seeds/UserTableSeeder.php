<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\User;

class UserTableSeeder extends Seeder
{
  
  public function run()
  {
    User::create([
      'username'   => 'admin',
      'first_name' => 'Administrador',
      'last_name'  => 'del Sistema',
      'password'   => '123',
      ]);

    User::create([
      'username'   => 'yardelysg',
      'first_name' => 'Yardelys Yolimar',
      'last_name'  => 'Gil Ortiz',
      'password'   => 'A-2015-003',
      ]);

    User::create([
      'username'   => 'eddys',
      'first_name' => 'Eddy Leddy',
      'last_name'  => 'Sánchez De Casasanta',
      'password'   => '17171785',
      ]);

    User::create([
      'username'   => 'esgleel',
      'first_name' => 'Esglee Solibet',
      'last_name'  => 'López Daza',
      'password'   => '15273776',
      ]);

    User::create([
      'username'   => 'nathalyj',
      'first_name' => 'Nathaly Valentina',
      'last_name'  => 'Jiménez',
      'password'   => '18135435',
      ]);
  }
}