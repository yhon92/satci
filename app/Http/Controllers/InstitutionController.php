<?php namespace SATCI\Http\Controllers;

use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\InstitutionRepo;

use Illuminate\Http\Request;

class InstitutionController extends Controller {

	protected $institutionRepo;

	public function __construct (InstitutionRepo $institutionRepo)
	{
		$this->institutionRepo = $institutionRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$institutions = $this->institutionRepo->getListInstitution();

		return response()->json([

			'institutions' => $institutions->toArray(),

			], 200);
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
