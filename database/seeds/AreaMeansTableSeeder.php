<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Area;

use Faker\Factory as Faker;

class AreaMeansTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $areas = [
    /****     Organigrama Alcaldía de Jiménez     ****/
      'Adjunto Alcalde',
      'Departamento de Administración Tributaria',
      'Departamento de Catastro y Tierras Urbanas',
      'Departamento de Fiscalización Tributaria',
      'Departamento de Gestión Administrativa y Contable',
      'Departamento de Gestión de Bienes',
      'Departamento de Gestión de Compras',
      'Departamento de Gestión de Servicios de Informática',
      'Departamento de Gestión de Tesorería',
      'Departamento de Gestión Humana y Cambio',
      'Departamento de Mantenimiento y Servicios Públicos', 
      'Departamento de Movilidad y Transporte',
      'Departamento de Prevención de Riesgos',
      'Departamento de Programas a Grupos de Especial Atención',
      'Departamento de Programas de Salud y Educativos', 
      'Departamento de Proyectos y Obras',
      'Departamento de Relaciones Interinstitucionales',
      'Despacho del Alcalde',
      'Dirección General de Finanzas, Administración y Control de Gestión',
      'Dirección General de Seguridad Ciudadana',
      'Dirección General de Servicios Comunitarios',
      'División de Comunicaciones Internas y Externas',
      'División de Gestión Laboral',
      'División de Servicios Generales',
      'Gerencia de Administración Tributaria',
      'Gerencia de Gestión de Talento Humano',
      'Gerencia de Infraestructura',
      'Gerencia De Relaciones Y Comunicaciones',
      'Oficina de Atención al Ciudadano',
      'Oficina de Consultoria Jurídica',
      'Oficina de Planificación Estratégica',
      'Oficina de Planificación y Presupuesto',
      'Sindicatura Municipal',
      'Unidad de Auditoría Interna',
    /****     Entes Paramunicipales     ****/
      'Bomberos',
      'FONDEC',
      'Fundación del Niño',
      'IMDEJIM',
      'IMVIJIM',
      'Protección Civil',
      'Registro Civil',
      'Sistema Municipal de Derecho y Defensa del Niño, Niña y Adolescente',
      'Sistema Municipal de Protección y Defensa del Niño, Niña y Adolescente',
    ];

    $faker = Faker::create('es_VE');
    
    $key = 0;

    foreach ($areas as $area) {
      $key++;
      if($area === 'Dirección General de Servicios Comunitarios')
      {
        Area::find($key)->means()->attach([1,2]);
      }
      else{
        Area::find($key)->means()->attach(1);
      }
    }     
  }
}
