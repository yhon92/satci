<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Area;

use Faker\Factory as Faker;

class AreaTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 12) as $index) {

			Area::create([
				'name'					=> $faker->unique()->word,
				'director_id'		=> $faker->unique()->numberBetween($min = 1, $max = 12),
			]);


		}
	}
}