<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Category;

use Faker\Factory as Faker;
class CategoryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create('es_VE');

    foreach (range(1, 12) as $index) {

      Category::create([
        'name'  => 'Categoria-'.$index,
        ]);

    }
  }
}
