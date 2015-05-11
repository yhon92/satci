<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Director;

use Faker\Factory as Faker;

class DirectorTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 12) as $index) {

			$first_name = $faker->firstName.' '.$faker->firstName;
			$last_name = $faker->lastName.' '.$faker->lastName;

			$full_name = $first_name.' '.$last_name;


			Director::create([
				'identification' => $faker->randomNumber(8),
				'full_name' 	 	 => $full_name,
				'first_name' 	 	 => $first_name,
				'last_name' 	 	 => $last_name,
				'prefix_phone' 	 => $faker->randomElement(['0412', '0414', '0424', '0416', '0426', '0253', '0251', '0212']),
				'number_phone' 	 => $faker->randomNumber(7),
				'email' 				 => $faker->unique()->email,
				'resolution' 		 => 'A-2015-0'.$faker->numberBetween($min = 01, $max = 99),
			]);


		}
	}
}