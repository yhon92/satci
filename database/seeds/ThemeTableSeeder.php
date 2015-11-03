<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Theme;

use Faker\Factory as Faker;

class ThemeTableSeeder extends Seeder
{
	
	public function run()
	{

		$faker = Faker::create('es_VE');

		foreach (range(1, 12) as $index) {

			Theme::create([
				'name'	=> 'Tema-'.$index,
			]);


		}
	}
}