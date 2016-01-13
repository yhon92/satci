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
      'description' => 'Acceso y permiso para CREAR las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Editar Solicitud',
      'slug' => 'edit-solicitude',
      'description' => 'Acceso y permiso para EDITAR las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Ver Solicitud',
      'slug' => 'show-solicitude',
      'description' => 'Acceso y permiso para VER las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Crear Asignación de Solicitud',
      'slug' => 'create-assign-solicitude',
      'description' => 'Acceso y permiso para CREAR las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Editar Asignación de Solicitud',
      'slug' => 'edit-assign-solicitude',
      'description' => 'Acceso y permiso para EDITAR las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Crear Solicitante',
      'slug' => 'create-applicant',
      'description' => 'Acceso y permiso para CREAR los solicitantes', // optional
    ]);

    Permission::create([
      'name' => 'Editar Solicitante',
      'slug' => 'edit-applicant',
      'description' => 'Acceso y permiso para EDITAR los solicitantes', // optional
    ]);

    Permission::create([
      'name' => 'Ver Solicitante',
      'slug' => 'show-applicant',
      'description' => 'Acceso y permiso para VER los solicitantes', // optional
    ]);

    Permission::create([
      'name' => 'Eliminar Solicitante',
      'slug' => 'delete-applicant',
      'description' => 'Acceso y permiso para ELIMINAR los solicitantes', // optional
    ]);

    Permission::create([
      'name' => 'Configuración',
      'slug' => 'config',
      'description' => 'Acceso y permiso acceder a la configuración', // optional
    ]);

    Permission::create([
      'name' => 'Seguridad',
      'slug' => 'security',
      'description' => 'Acceso y permiso acceder a la seguridad', // optional
    ]);
  }
}
