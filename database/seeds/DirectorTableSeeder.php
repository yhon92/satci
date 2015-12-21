<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\Director;

class DirectorTableSeeder extends Seeder
{
	
	public function run()
	{
		Director::create([
			'identification' => '20321791',
			'full_name' 	 	 => 'Ysabela Nazaret Rodriguez Rizalez',
			'first_name' 	 	 => 'Ysabela Nazaret',
			'last_name' 	 	 => 'Rodriguez Rizalez',
			'prefix_phone' 	 => '0424',
			'number_phone' 	 => '5836356',
			'email' 				 => 'ysa_nrr@yahoo.es',
			'resolution' 		 => 'A-2015-07',
			]);
		
		Director::create([
			'identification' => '11589328',
			'full_name' 	 	 => 'Graciela Dayanna Lara Hernandez',
			'first_name' 	 	 => 'Graciela Dayanna',
			'last_name' 	 	 => 'Lara Hernandez',
			'prefix_phone' 	 => '0414',
			'number_phone' 	 => '5538232',
			'email' 				 => 'larademgraciela@hotmail.com',
			'resolution' 		 => 'A-2015-10',
			]);

		Director::create([
			'identification' => '18527699',
			'full_name' 	 	 => 'Guiillermo Alejandro Delfin Echeverria',
			'first_name' 	 	 => 'Guiillermo Alejandro',
			'last_name' 	 	 => 'Delfin Echeverria',
			'prefix_phone' 	 => '0412',
			'number_phone' 	 => '6703985',
			'email' 				 => 'guillermodelfinec@gmail.com',
			'resolution' 		 => 'A-2015-03',
			]);

		Director::create([
			'identification' => '22329779',
			'full_name' 	 	 => 'Naylin Mariel Ovalles Uzcategui',
			'first_name' 	 	 => 'Naylin Mariel',
			'last_name' 	 	 => 'Ovalles Uzcategui',
			'prefix_phone' 	 => '0426',
			'number_phone' 	 => '3506793',
			'email' 				 => 'naylinovalles@gmail.com',
			'resolution' 		 => 'A-2015-04',
			]);

		Director::create([
			'identification' => '19828960',
			'full_name' 	 	 => 'Yoenny David Gil Quintero',
			'first_name' 	 	 => 'Yoenny David',
			'last_name' 	 	 => 'Gil Quintero',
			'prefix_phone' 	 => '0414',
			'number_phone' 	 => '5707936',
			'email' 				 => 'yoennygil@gmail.com',
			'resolution' 		 => 'A-2015-01',
			]);

		Director::create([
			'identification' => '16736321',
			'full_name' 	 	 => 'Kareng Yudibeth Hernández Valera',
			'first_name' 	 	 => 'Kareng Yudibeth',
			'last_name' 	 	 => 'Hernández Valera',
			'prefix_phone' 	 => '0414',
			'number_phone' 	 => '3389361',
			'email' 				 => 'karenghernandez06@gmail.com',
			'resolution' 		 => 'A-2015-02',
			]);

		Director::create([
			'identification' => '5749003',
			'full_name' 	 	 => 'Nieves Dacil Hernández Lorenzo',
			'first_name' 	 	 => 'Nieves Dacil',
			'last_name' 	 	 => 'Hernández Lorenzo',
			'prefix_phone' 	 => '0414',
			'number_phone' 	 => '3511682',
			'email' 				 => 'dacil17@hotmail.com',
			'resolution' 		 => 'A-2015-05',
			]);

		Director::create([
			'identification' => '7315988',
			'full_name' 	 	 => 'José Alberto Noguera Yanez',
			'first_name' 	 	 => 'José Alberto',
			'last_name' 	 	 => 'Noguera Yanez',
			'prefix_phone' 	 => '0414',
			'number_phone' 	 => '5207343',
			'email' 				 => 'josealbertonoguera@gmail.com',
			'resolution' 		 => 'A-2015-06',
			]);


		Director::create([
			'identification' => '13922761',
			'full_name' 	 	 => 'Jorge Luis Chirinos Gonzalez',
			'first_name' 	 	 => 'Jorge Luis',
			'last_name' 	 	 => 'Chirinos Gonzalez',
			'prefix_phone' 	 => '0414',
			'number_phone' 	 => '5220441',
			'email' 				 => 'lic_jorgeluischirinos@yahoo.es',
			'resolution' 		 => 'A-2015-08',
			]);

		Director::create([
			'identification' => '15616926',
			'full_name' 	 	 => 'Ruben Vargas Salas',
			'first_name' 	 	 => 'Ruben',
			'last_name' 	 	 => 'Vargas Salas',
			'prefix_phone' 	 => '0424',
			'number_phone' 	 => '5411732',
			'email' 				 => 'ruben_vargas@hotmail.com',
			'resolution' 		 => 'A-2015-09',
			]);
	}
}