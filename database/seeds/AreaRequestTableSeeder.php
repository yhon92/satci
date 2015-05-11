<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\AreaRequest;

use Faker\Factory as Faker;

class AreaRequestTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 100) as $index) {

			AreaRequest::create([
				'theme_request_id'	=> $faker->numberBetween($min = 1, $max = 100),
				'area_id'		=> $faker->numberBetween($min = 1, $max = 12),
			]);


		}
	}
}