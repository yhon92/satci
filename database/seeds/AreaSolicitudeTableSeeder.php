<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\AreaSolicitude;

use Faker\Factory as Faker;

class AreaSolicitudeTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 100) as $index) {

			AreaSolicitude::create([
				'theme_solicitude_id'	=> $faker->numberBetween($min = 1, $max = 100),
				'area_id'		=> $faker->numberBetween($min = 1, $max = 12),
			]);


		}
	}
}