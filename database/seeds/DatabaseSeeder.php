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
		$this->call('CategoryTableSeeder');
		$this->call('DirectorTableSeeder');
		$this->call('CitizenTableSeeder');
		$this->call('InstitutionTableSeeder');
		$this->call('ThemeTableSeeder');
		$this->call('AreaTableSeeder');
		$this->call('SolicitudeTableSeeder');
		/*$this->call('ThemeAreaSolicitudeTableSeeder');
		$this->call('InstrumentTableSeeder');
		$this->call('AnswerTableSeeder');*/
	}

}
