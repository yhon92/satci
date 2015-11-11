<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Area;

use Faker\Factory as Faker;

class AreaTableSeeder extends Seeder
{
	
	public function run()
	{

		$areas = [
							'Departamento de Apoyo Social', 
							'Departamento de Catastro y Tierras Urbanas', 
							'Departamento de Gestión de Bienes', 
							'Departamento de Gestión de Servicios de Informática', 
							'Departamento de Mantenimiento y Servicios Públicos', 
							'Departamento de Movilidad y Transporte', 
							'Departamento de Programas de Especial Atención', 
							'Departamento de Programas de Salud y Educativos', 
							'Departamento de Proyectos y Obras', 
							'Despacho del Alcalde',
							'Dirección General de Finanzas, Administración y Control de Gestión', 
							'Dirección General de Seguridad Ciudadana', 
							'Dirección General de Servicios Comunitarios', 
							'FONDEC', 
							'Fundación del Niño', 
							'Gerencia de Administración Tributaria', 
							'Gerencia de Gestión de Talento Humano', 
							'Gerencia de Realciones Interinstitucionales', 
							'IMDEJIM', 
							'INVIJIM', 
							'Oficina de Atención al Ciudadano', 
							'Oficina de Consultores Jurídicos', 
							'Oficina de Planificación Estratégica', 
							'Sindicatura Municipal', 
							'Sistema Municipal de Derecho y Defensa del Niño, Niña y Adolescente', 
							'Sistema Municipal de Protección y Defensa del Niño, Niña y Adolescente', 
							'Unidad de Auditoría Interna', 
		];

		$faker = Faker::create('es_VE');

		foreach ($areas as $area) {

			Area::create([
				'name'					=> $area,
				// 'director_id'		=> $faker->unique()->numberBetween($min = 1, $max = 10),
				'director_id'		=> $faker->numberBetween($min = 1, $max = 10),
			]);


		}
	}
}