<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\ThemeSolicitude;

use Faker\Factory as Faker;

class ThemeSolicitudeTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 100) as $index) {

			ThemeSolicitude::create([
				'solicitude_id'	=> $faker->numberBetween($min = 1, $max = 765),
				'theme_id'		=> $faker->numberBetween($min = 1, $max = 12),
			]);


		}
	}
}