<?php

use Illuminate\Database\Seeder;
use SATCI\Entities\User;

class UserTableSeeder extends Seeder
{
	
	public function run()
	{
		User::create([
			'username' 	 => 'admin',
			'first_name' => 'Administrador',
			'last_name'  => 'del Sistema',
			'password' 	 => '123',
			]);
	}
}