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
      'name' => 'Seguridad',
      'slug' => 'security',
      'description' => 'Permiso para acceder al módulo de seguridad', // optional
    ]);

    Permission::create([
      'name' => 'Configuración',
      'slug' => 'config',
      'description' => 'Permiso para acceder al módulo de configuración', // optional
    ]);

    Permission::create([
      'name' => 'Solicitud',
      'slug' => 'solicitude',
      'description' => 'Permiso para acceder al módulo de solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Solicitante',
      'slug' => 'applicant',
      'description' => 'Permiso para acceder al módulo de solicitantes', // optional
    ]);

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
      'name' => 'Cambiar Estado de Solicitud',
      'slug' => 'change-state-solicitude',
      'description' => 'Permiso para CAMBIAR el estado las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Ver Solicitud',
      'slug' => 'view-solicitude',
      'description' => 'Acceso y permiso para VER las solicitudes', // optional
    ]);

    Permission::create([
      'name' => 'Crear Asignación de Solicitud',
      'slug' => 'create-assign-solicitude',
      'description' => 'Acceso y permiso para CREAR las asignaciones', // optional
    ]);

    Permission::create([
      'name' => 'Editar Asignación de Solicitud',
      'slug' => 'edit-assign-solicitude',
      'description' => 'Acceso y permiso para EDITAR las asignaciones', // optional
    ]);

    Permission::create([
      'name' => 'Cambiar Estado de Asignación de Solicitud',
      'slug' => 'change-state-assign-solicitude',
      'description' => 'Permiso para CAMBIAR el estado de las asignacines', // optional
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
      'slug' => 'view-applicant',
      'description' => 'Acceso y permiso para VER los solicitantes', // optional
    ]);

    Permission::create([
      'name' => 'Eliminar Solicitante',
      'slug' => 'delete-applicant',
      'description' => 'Acceso y permiso para ELIMINAR los solicitantes', // optional
    ]);


  }
}
