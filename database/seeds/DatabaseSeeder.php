<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->call('ParishTableSeeder');
		$this->call('DirectorTableSeeder');
		$this->call('CitizenTableSeeder');
		$this->call('InstitutionTableSeeder');
		$this->call('ThemeTableSeeder');
		$this->call('AreaTableSeeder');
		$this->call('RequestTableSeeder');
		$this->call('ThemeRequestTableSeeder');
		$this->call('AreaRequestTableSeeder');
		$this->call('InstrumentTableSeeder');
		$this->call('ResponseTableSeeder');
	}

}
