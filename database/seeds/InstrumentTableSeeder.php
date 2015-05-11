<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Instrument;

use Faker\Factory as Faker;

class InstrumentTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 100) as $index) {

			Instrument::create([
				'date'						=> $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now'),
				'area_request_id'	=> $faker->numberBetween($min = 1, $max = 100),
				'observation'			=> $faker->realText($maxNbChars = 200),
			]);


		}
	}
}