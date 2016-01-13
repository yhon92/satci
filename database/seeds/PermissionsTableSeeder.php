<?php

use Illuminate\Database\Seeder;
use Johnnymn\Sim\Roles\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Permission::create([
      'name' => 'Crear Solicitud',
      'slug' => 'create-solicitude',
      'description' => 'Acceso y Permiso para crear las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Editar Solicitud',
      'slug' => 'edit-solicitude',
      'description' => 'Acceso y Permiso para editar las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Ver Solicitud',
      'slug' => 'show-solicitude',
      'description' => 'Acceso y Permiso para ver las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Asignar Solicitud',
      'slug' => 'assign-solicitude',
      'description' => 'Acceso y Permiso para editar las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Editar Asignación de Solicitud',
      'slug' => 'edit-assign-solicitude',
      'description' => 'Acceso y Permiso para editar las solicitudes', // optional
    ]);
  }
}
