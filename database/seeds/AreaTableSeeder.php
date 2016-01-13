<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Area;

use Faker\Factory as Faker;

class AreaTableSeeder extends Seeder
{
  
  public function run()
  {

    $areas = [
    /****     Organigrama Alcaldía de Jiménez     ****/
      ['name' => 'Adjunto Alcalde', 'email' => 'No tiene'], 
      // ['name' => 'Departamento de Administración Tributaria', 'email' => ''], 
      ['name' => 'Departamento de Catastro y Tierras Urbanas', 'email' => 'No tiene'], 
      ['name' => 'Departamento de Fiscalización Tributaria', 'email' => 'No tiene'], 
      ['name' => 'Departamento de Gestión Administrativa y Contable', 'email' => 'No tiene'], 
      ['name' => 'Departamento de Gestión de Bienes', 'email' => ''],
      ['name' => 'Departamento de Gestión de Compras', 'email' => 'comprasalcaldiadejimenez@gmail.com'], 
      ['name' => 'Departamento de Gestión de Servicios de Informática', 'email' => 'dpto.informatica.alcaldia@gmail.com'], 
      ['name' => 'Departamento de Gestión de Tesorería', 'email' => 'No tiene'], 
      // ['name' => 'Departamento de Gestión Humana y Cambio', 'email' => ''], 
      ['name' => 'Departamento de Mantenimiento y Servicios Públicos',  'email' => 'No tiene'], 
      ['name' => 'Departamento de Movilidad y Transporte', 'email' => 'No tiene'], 
      // ['name' => 'Departamento de Prevención de Riesgos', 'email' => ''], 
      ['name' => 'Departamento de Programas a Grupos de Especial Atención', 'email' => 'No tiene'], 
      ['name' => 'Departamento de Programas de Salud y Educativos',  'email' => 'dptodeprogramasaludyeducativos@gmail.com'], 
      ['name' => 'Departamento de Proyectos y Obras', 'email' => 'No tiene'], 
      ['name' => 'Departamento de Relaciones Interinstitucionales', 'email' => 'No tiene'], 
      ['name' => 'Despacho del Alcalde', 'email' => 'No tiene'],
      ['name' => 'Dirección General de Finanzas, Administración y Control de Gestión', 'email' => 'No tiene'],
      // ['name' => 'Dirección General de Seguridad Ciudadana', 'email' => ''],
      ['name' => 'Dirección General de Servicios Comunitarios', 'email' => 'No tiene'],
      ['name' => 'División de Comunicaciones Internas y Externas', 'email' => 'prensaalcaldiadejimenez@gmail.com'],
      ['name' => 'División de Gestión Laboral', 'email' => 'rh.alcaldiajimenez@gmail.com'],
      ['name' => 'División de Servicios Generales', 'email' => 'No tiene'],
      ['name' => 'Gerencia de Administración Tributaria', 'email' => 'No tiene'],
      ['name' => 'Gerencia de Gestión de Talento Humano', 'email' => 'No tiene'],
      // ['name' => 'Gerencia de Infraestructura', 'email' => ''],
      // ['name' => 'Gerencia de Relaciones y Comunicaciones', 'email' => ''],
      ['name' => 'Oficina de Atención al Ciudadano', 'email' => 'No tiene'],
      // ['name' => 'Oficina de Consultoria Jurídica', 'email' => ''],
      ['name' => 'Oficina de Planificación Estratégica', 'email' => 'No tiene'],
      ['name' => 'Oficina de Planificación y Presupuesto', 'email' => 'presupuestojimenez@gmail.com'],
      ['name' => 'Sindicatura Municipal', 'email' => 'No tiene'],
      ['name' => 'Unidad de Auditoría Interna', 'email' => 'No tiene'],
      ['name' => 'Secretaria de Despacho', 'email' => 'No tiene'],
      ['name' => 'Servicios Publicos Agua', 'email' => 'No tiene'],
    /****     Entes Paramunicipales     ****/
      // ['name' => 'Bomberos', 'email' => ''],
      // ['name' => 'FONDEC', 'email' => ''],
      // ['name' => 'Fundación del Niño', 'email' => ''],
      // ['name' => 'IMDEJIM', 'email' => ''],
      // ['name' => 'IMVIJIM', 'email' => ''],
      // ['name' => 'Protección Civil', 'email' => ''],
      ['name' => 'Registro Civil', 'email' => 'No tiene'],
      // ['name' => 'Sistema Municipal de Derecho y Defensa del Niño, Niña y Adolescente', 'email' => ''],
      // ['name' => 'Sistema Municipal de Protección y Defensa del Niño, Niña y Adolescente', 'email' => ''],
    ];

    $faker = Faker::create('es_VE');

    $i = 0;
    foreach ($areas as $area) {
      $i++;
      Area::create([
        'name' => $area['name'],
        'email' => $area['email'],
        'director_id' => $i,
      ]);


    }
  }
}