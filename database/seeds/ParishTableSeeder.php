<?php

use Illuminate\Database\Seeder;

class ParishTableSeeder extends Seeder
{
	
	public function run()
	{
		\DB::table('parishes')->insert(array(
			'id' => '1',
			'name' => 'Coronel Mariano Peraza',
			));

		\DB::table('parishes')->insert(array(
			'id' => '2',
			'name' => 'Cuara',
			));

		\DB::table('parishes')->insert(array(
			'id' => '3',
			'name' => 'Diego de Lozada',
			));

		\DB::table('parishes')->insert(array(
			'id' => '4',
			'name' => 'José Bernardo Dorante',
			));

		\DB::table('parishes')->insert(array(
			'id' => '5',
			'name' => 'Juan Bautista Rodríguez',
			));

		\DB::table('parishes')->insert(array(
			'id' => '6',
			'name' => 'Paraíso de San José',
			));

		\DB::table('parishes')->insert(array(
			'id' => '7',
			'name' => 'San Miguel',
			));

		\DB::table('parishes')->insert(array(
			'id' => '8',
			'name' => 'Tintorero',
			));

		/*\DB::table('parishes')->insert(array(
			'id' => '',
			'name' => '',
			));*/
	}
}