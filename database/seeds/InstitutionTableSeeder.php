<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Institution;

use Faker\Factory as Faker;

class InstitutionTableSeeder extends Seeder
{
  
  public function run()
  {

    $faker = Faker::create('es_VE');

    foreach (range(1, 10) as $index) {

      $first_name = $faker->firstName.' '.$faker->firstName;
      $last_name = $faker->lastName.' '.$faker->lastName;

      $full_name = $first_name.' '.$last_name;


      Institution::create([
        'identification'        => $faker->regexify('[A-J]{1}-[0-9+]{9}'),
        'full_name'             => $faker->company,
        'address'               => $faker->address,
        'prefix_phone'          => $faker->randomElement(['0412', '0414', '0424', '0416', '0426', '0253', '0251', '0212']),
        'number_phone'          => $faker->randomNumber(7),
        'agent_identification'  => $faker->randomNumber(8),
        'agent_full_name'       => $full_name,
        'agent_first_name'      => $first_name,
        'agent_last_name'       => $last_name,
        'parish_id'             => $faker->numberBetween($min = 1, $max = 8),
        // 'email' => $faker->unique()->email,
        // 'resolution' => 'A-2015-0'.$faker->randomNumber(2),
      ]);


    }
  }
}