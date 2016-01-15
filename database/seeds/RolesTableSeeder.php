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

    $adminRole->attachPermission(1);
    $adminRole->attachPermission(2);
    $adminRole->attachPermission(3);
    $adminRole->attachPermission(4);
    $adminRole->attachPermission(5);
    $adminRole->attachPermission(6);
    $adminRole->attachPermission(7);
    $adminRole->attachPermission(8);
    $adminRole->attachPermission(9);
    $adminRole->attachPermission(10);
    $adminRole->attachPermission(11);
    $adminRole->attachPermission(12);
    $adminRole->attachPermission(13);
    $adminRole->attachPermission(14);
    $adminRole->attachPermission(15);

    $coordinatorRole = Role::create([
      'name' => 'Coordinador',
      'slug' => 'coordinator',
      'description' => '',
    ]);

    $coordinatorRole->attachPermission(1);
    $coordinatorRole->attachPermission(2);
    $coordinatorRole->attachPermission(3);
    $coordinatorRole->attachPermission(4);
    $coordinatorRole->attachPermission(5);
    $coordinatorRole->attachPermission(6);
    $coordinatorRole->attachPermission(7);
    $coordinatorRole->attachPermission(8);
    $coordinatorRole->attachPermission(9);
    $coordinatorRole->attachPermission(10);
    $coordinatorRole->attachPermission(11);
    $coordinatorRole->attachPermission(12);
    $coordinatorRole->attachPermission(13);
    $coordinatorRole->attachPermission(14);
    $coordinatorRole->attachPermission(15);

    $moderatorRole = Role::create([
      'name' => 'Moderador',
      'slug' => 'moderator',
      'description' => '',
    ]);

    $moderatorRole->attachPermission(3);
    $moderatorRole->attachPermission(4);
    $moderatorRole->attachPermission(5);
    $moderatorRole->attachPermission(6);
    $moderatorRole->attachPermission(8);
    $moderatorRole->attachPermission(12);
    $moderatorRole->attachPermission(13);
    $moderatorRole->attachPermission(14);
    $moderatorRole->attachPermission(15);

    $guestRole = Role::create([
      'name' => 'Invitado',
      'slug' => 'guest',
      'description' => '',
    ]);

    $guestRole->attachPermission(3);
    $guestRole->attachPermission(8);
    

  }
}
