<?php 
namespace SATCI\Http\Controllers;

use Illuminate\Http\Request;

use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateCitizenRequest;
use SATCI\Http\Requests\EditCitizenRequest;
use SATCI\Repositories\CitizenRepo;

class CitizenController extends Controller {

	protected $citizenRepo;

	public function __construct (CitizenRepo $citizenRepo)
	{
		// $this->middleware('jwt.auth');
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

			'citizens' => $citizens,

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
		$citizen = $this->citizenRepo->newCitizen($request->all());
		
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
		$citizen = $this->citizenRepo->getCitizen($id);

		return response()->json(['citizen' => $citizen], 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditCitizenRequest $request)
	{
		try 
    {
      $this->citizenRepo->update($id, $request->all());
    }
    catch (QueryException $e)
    {
      \Log::info($e->errorInfo[2]);
      return response()->json(['error' => true], 200);
    }

		return response()->json(['success' => true], 200);
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
