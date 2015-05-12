<?php namespace SATCI\Http\Controllers;

use SATCI\Entities\Solicitude;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Solicitude $solicitude)
	{
		$solicitudes = $solicitude->paginate(10)->all();
		// dd($requests);
		return view('home', compact('solicitudes'));
	}

}
