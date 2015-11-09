<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Theme;

use Faker\Factory as Faker;

class ThemeTableSeeder extends Seeder
{
	
	public function run()
	{
		// $themes = ['Peticiones' => [
		$themes = [[
													'Apoyo Tecnológico', 
													'Consultas Jurídicas', 
													'Asesorías Trámites de Terrenos', 
													'Apoyo Logístico', 
													'Apoyo de Sonido y Video', 
													'Bienes Desincorporados', 
													'Préstamos de Brinca-Brinca', 
													'Audiencias', 
													'Crédito a Pequeños Emprendedores', 
													'Licencias', 
													'Solicitud Croquis', 
													'Mensura', 
													'Solvencia Municipal', 
													'Personal de la Alcaldía'],

							 // 'Comunidad' 	=> [
							 [
							 						'Atención a Comunidades', 
				 									'Limpieza de vías Públicas', 
				 									'Aseo Urbano', 
				 									'Proyecto de las Comunidades', 
				 									'Suministro de Agua Potable', 
				 									'Planes Vacacionales', 
				 									'Actividades Recreativas con Niños, Niñas y Adolescente', 
				 									'Seguridad'],

							 // 'Deportivas' => [
							 [
							 						'Equipo Deportivo', 
				 									'Permiso de los Espacios Deportivos', 
				 									'Programas Deportivos'],

							 // 'Educativas' => [
							 [
							 						'Convenios Educativos',							 									
			 										'Insumos a Escuelas', 
				 									'Ayuda Económica'],

							 // 'Salud' 			=> [
							 [
							 						'Intervenciones Quirúrgicas', 
													'Operativo Médico', 
				 									'Medicina', 
				 									'Exámenes', 
				 									'Insumos', 
				 									'Ambulatorios', 
				 									'Persona con Diversidad Funcional', 
				 									'Adultos Mayores'],

							 // 'Habitat'		=> [
							 [
							 						'Solicitudes de Vivienda', 
				 									'Inspeccion a vivienda en mal estado', 
				 									'Proyecto de vivienda', 
				 									'Materiales de construcción', 
				 									'Titularidad de las tierras', 
				 									'Permiso de construcción'],

							 // 'Denuncia' 	=> [
							 [
							 						'Ventas clandestinas', 
				 									'Demandas'],

							 // 'Correspondencia Interna' => [
							 [
				 									'Dozavos', 
				 									'Transferencias de Recursos', 
				 									'Solicitudes de Crédito Adicionales', 
				 									'Requerimiento de Materiales de Oficina', 
				 									'Trámites Legales', 
				 									'Convenios', 
				 									'Resoluciones'],

							 // 'Reclamo' 		=> [
							 [
						 							'Problemática de las comunidades con respecto a servicios públicos y vialidad', 
				 									'Efectuadas Por Personal Que Labora En La Alcaldía', 
				 									'Aseo', 
				 									'Agua', 
				 									'Transporte'],

							 // 'Aviso' 			=> [
							 [
							 						'Invitaciones', 
				 									'Notificaciones', 
				 									'Facturas'],

							 // 'Sugerencia' => [
							 [
							 						'Propuestas de Proyectos', 
				 									'Propuestas con Respecto al Transporte', 
				 									'Proyecto Turístico', 
				 									'Proyecto de cultivo'],
							];
		$key = 0;
		foreach ($themes as $theme) {
			$key++;
			foreach ($theme as $value) {
				// print $value;
				Theme::create([
					'category_id'	=> $key,
					'name'				=> $value,
				]);
			}

		}
	}
}