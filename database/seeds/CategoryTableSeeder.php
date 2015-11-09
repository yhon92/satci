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
    $categories = ['Peticiones', 
                   'Comunidad', 
                   'Deportivas', 
                   'Educativas', 
                   'Salud', 
                   'Habitat',  
                   'Denuncia',  
                   'Correspondencia Interna',  
                   'Reclamo',  
                   'Aviso',  
                   'Sugerencia'];

    foreach ($categories as $category) {

      Category::create([
        'name'  => $category,
        ]);

    }
  }
}
