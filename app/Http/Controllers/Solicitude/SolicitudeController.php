<?php namespace SATCI\Http\Controllers\Solicitude;

use SATCI\Http\Entities\Solicitude;
use SATCI\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SolicitudeController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');

		$this->beforeFilter('@findSolicitude', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

	public function findSolicitude(Route $route)
	{
		$this->solicitude = Solicitude::findOrFail($route->getParameter('solicitude'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('solicitude.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('solicitude.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
