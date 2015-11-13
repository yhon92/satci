<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Means;

class MeansTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Means::create([
    'id' => '1',
    'name' => 'Recursos Propios',
    ]);

    Means::create([
    'id' => '2',
    'name' => 'Responsabilidad Social',
    ]);
  }
}
