<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Solicitude;

use Faker\Factory as Faker;

class SolicitudeTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 765) as $index) {

			// $date = $faker->date($format = 'Y-m-d', $max = 'now');
			$date = $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now');

			Solicitude::create([
				'solicitude_number'			=> '000-'.$index+=122,
				'reception_date'			=> $date,
				'identification_type'	=> $faker->randomElement(['Natural', 'Jurídica']),
				'applicant_id'				=> $faker->numberBetween($min = 1, $max = 30),
				'document_date'				=> $date,
				'topic'								=> $faker->text($maxNbChars = 200),
				'status'							=> 'Recibido',
			]);


		}
	}
}