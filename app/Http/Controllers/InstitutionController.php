<?php namespace SATCI\Http\Controllers;

use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateInstitutionRequest;
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
		$institutions = $this->institutionRepo->getListInstitutions();

		return response()->json([

			'institutions' => $institutions->toArray(),

			], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateInstitutionRequest $request)
	{
		$institution = $this->institutionRepo->newInstitution($request->all());

		return response()->json([
				'success' => true,
				'institution' => $institution,
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
