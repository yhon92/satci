<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Parish;

class ParishTableSeeder extends Seeder
{
	
	public function run()
	{
		Parish::create([
			'id' => '1',
			'name' => 'Coronel Mariano Peraza',
			]);

		Parish::create([
			'id' => '2',
			'name' => 'Cuara',
			]);

		Parish::create([
			'id' => '3',
			'name' => 'Diego de Lozada',
			]);

		Parish::create([
			'id' => '4',
			'name' => 'José Bernardo Dorante',
			]);

		Parish::create([
			'id' => '5',
			'name' => 'Juan Bautista Rodríguez',
			]);

		Parish::create([
			'id' => '6',
			'name' => 'Paraíso de San José',
			]);

		Parish::create([
			'id' => '7',
			'name' => 'San Miguel',
			]);

		Parish::create([
			'id' => '8',
			'name' => 'Tintorero',
			]);

		/*\DB::table('parishes')->insert(array(
			'id' => '',
			'name' => '',
			));*/
	}
}