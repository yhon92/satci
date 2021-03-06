<?php 
namespace SATCI\Services;

use SATCI\Entities\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract
{

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'username' => 'required|max:255',
			'password' => 'required|confirmed|min:3',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'username' => $data['username'],
			'password' => bcrypt($data['password']),
		]);
	}

}
