<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Answer;

use Faker\Factory as Faker;

class AnswerTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 50) as $index) {

			Answer::create([
				'instrument_id'	=> $faker->numberBetween($min = 1, $max = 50),
				'date'					=> $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now'),
				'number_job'		=> 'ATC-O-'.$index+=122,
				'observation'		=> $faker->realText($maxNbChars = 200),
			]);


		}
	}
}