<?php

use Illuminate\Database\Seeder;
use Johnnymn\Sim\Roles\Models\Role;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $adminRole = Role::create([
      'name' => 'Administrador',
      'slug' => 'admin',
      'description' => '',
    ]);


    $coordinatorRole = Role::create([
      'name' => 'Coordinador',
      'slug' => 'coordinator',
      'description' => '',
    ]);

    $moderatorRole = Role::create([
      'name' => 'Moderador',
      'slug' => 'moderator',
      'description' => '',
    ]);

    $guestRole = Role::create([
      'name' => 'Invitado',
      'slug' => 'guest',
      'description' => '',
    ]);
  }
}
