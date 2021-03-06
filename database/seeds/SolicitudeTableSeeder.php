<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Solicitude;

use Faker\Factory as Faker;

class SolicitudeTableSeeder extends Seeder
{
  
  public function run()
  {

    $faker = Faker::create('es_VE');

    foreach (range(1, 10) as $index) {

      // $date = $faker->date($format = 'Y-m-d', $max = 'now');
      $date = $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now');

      Solicitude::create([
        'id'                => \Uuid::generate(5, 'SATCI', \Uuid::generate()),
        'solicitude_number' => str_pad($index, 8, '0', STR_PAD_LEFT),
        'reception_date'    => $date,
        'applicant_type'    => $faker->randomElement(['SATCI\Entities\Citizen', 'SATCI\Entities\Institution']),
        'applicant_id'      => $faker->numberBetween($min = 1, $max = 10),
        'document_date'     => $date,
        'topic'             => $faker->text($maxNbChars = 200),
        'status'            => 'Recibido',
      ]);


    }
  }
}