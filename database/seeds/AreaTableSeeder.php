<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Area;

use Faker\Factory as Faker;

class AreaTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 10) as $index) {

			Area::create([
				'name'					=> 'Area-'.$index,
				'director_id'		=> $faker->unique()->numberBetween($min = 1, $max = 10),
			]);


		}
	}
}