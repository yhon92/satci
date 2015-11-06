<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Theme;

use Faker\Factory as Faker;

class ThemeTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 50) as $index) {

			Theme::create([
				'category_id'	=> $faker->numberBetween($min = 1, $max = 12),
				'name'				=> 'Tema-'.$index,
			]);


		}
	}
}