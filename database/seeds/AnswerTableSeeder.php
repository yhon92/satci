<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Answer;

use Faker\Factory as Faker;

class AnswerTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 100) as $index) {

			Answer::create([
				'instrument_id'	=> $faker->numberBetween($min = 1, $max = 100),
				'number_job'		=> 'ATC-O-'.$index+=122,
				'observation'		=> $faker->realText($maxNbChars = 200),
			]);


		}
	}
}