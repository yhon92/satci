<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Instrument;

use Faker\Factory as Faker;

class InstrumentTableSeeder extends Seeder
{
  
  public function run()
  {

    $faker = Faker::create('es_VE');

    foreach (range(1, 50) as $index) {

      Instrument::create([
        'date'            => $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now'),
        'theme_area_solicitude_id'  => $faker->numberBetween($min = 1, $max = 50),
        'observation'     => $faker->realText($maxNbChars = 200),
      ]);


    }
  }
}