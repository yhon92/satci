<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\ThemeRequest;

use Faker\Factory as Faker;

class ThemeRequestTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 100) as $index) {

			ThemeRequest::create([
				'request_id'	=> $faker->numberBetween($min = 1, $max = 765),
				'theme_id'		=> $faker->numberBetween($min = 1, $max = 12),
			]);


		}
	}
}