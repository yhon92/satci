<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\User;

class UserTableSeeder extends Seeder
{
  
  public function run()
  {
    $user = User::create([
      'username'   => 'admin',
      'first_name' => 'Administrador',
      'last_name'  => 'del Sistema',
      'password'   => '123',
      ]);

    $user->attachRole(1);

    $user = User::create([
      'username'   => 'yardelysg',
      'first_name' => 'Yardelys Yolimar',
      'last_name'  => 'Gil Ortiz',
      'password'   => 'A-2015-003',
      ]);

    $user->attachRole(2);

    $user = User::create([
      'username'   => 'eddys',
      'first_name' => 'Eddy Leddy',
      'last_name'  => 'Sánchez De Casasanta',
      'password'   => '17171785',
      ]);

    $user->attachRole(3);

    $user = User::create([
      'username'   => 'esgleel',
      'first_name' => 'Esglee Solibet',
      'last_name'  => 'López Daza',
      'password'   => '15273776',
      ]);
    
    $user->attachRole(3);

    $user = User::create([
      'username'   => 'nathalyj',
      'first_name' => 'Nathaly Valentina',
      'last_name'  => 'Jiménez',
      'password'   => '18135435',
      ]);

    $user->attachRole(3);

  }
}