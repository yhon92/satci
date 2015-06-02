<?php namespace SATCI\Http\Controllers;

use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateCitizenRequest;
use SATCI\Repositories\CitizenRepo;

use Illuminate\Http\Request;

class CitizenController extends Controller {

	protected $citizenRepo;

	public function __construct (CitizenRepo $citizenRepo)
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
		$citizens = $this->citizenRepo->getListCitizens();
		
		return response()->json([

			'citizens' => $citizens->toArray(),

			], 200
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateCitizenRequest $request)
	{
		// dd($request);
		$citizen = $this->CitizenRepo->newCitizen($request->all());
		dd($citizen);
		return response()->json([
				'success' => true,
				'citizen' => $citizen,
			]);
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
