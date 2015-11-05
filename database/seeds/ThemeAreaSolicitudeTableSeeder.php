<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\ThemeAreaSolicitude;

use Faker\Factory as Faker;

class ThemeAreaSolicitudeTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 50) as $index) {

			ThemeAreaSolicitude::create([
				'solicitude_id'	=> $faker->numberBetween($min = 1, $max = 100),
				'theme_id'		=> $faker->numberBetween($min = 1, $max = 12),
				'area_id'		=> $faker->numberBetween($min = 1, $max = 10),
			]);


		}
	}
}