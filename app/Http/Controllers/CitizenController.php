<?php namespace SATCI\Http\Controllers;

// use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
// use SATCI\Entities\Citizen;
use SATCI\Repositories\CitizenRepo;

use Illuminate\Http\Request;

class CitizenController extends Controller {

	protected $citizenRepo;

	function __construct (CitizenRepo $citizenRepo)
	{
		$this->citizenRepo = $citizenRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$citizens = $this->citizenRepo->getListCitizen();
		
		// dd($citizens);

		return response()->json([

			'citizens' => $citizens->toArray()

			], 200
		);
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
