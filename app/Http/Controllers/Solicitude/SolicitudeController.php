<?php namespace SATCI\Http\Controllers\Solicitude;

use SATCI\Repositories\SolicitudeRepo;
use SATCI\Repositories\CitizenRepo;
use SATCI\Http\Requests\CreateSolicitudeRequest;
use SATCI\Http\Controllers\Controller;
use SATCI\Utils\Helpers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SolicitudeController extends Controller {

	protected $solicitudeRepo;
	protected $citizenRepo;

	public function __construct(SolicitudeRepo $solicitudeRepo, CitizenRepo $citizenRepo)
	{
		// $this->middleware('jwt.auth');
		$this->citizenRepo = $citizenRepo;
		$this->solicitudeRepo = $solicitudeRepo;
		// $this->beforeFilter('@findSolicitude', ['only' => ['show', 'edit', 'update', 'destroy']]);
	}

/*	public function findSolicitude(Route $route)
	{
		$this->solicitude = Solicitude::findOrFail($route->getParameter('solicitude'));
	}*/
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$solicitudes = $this->solicitudeRepo->getListSolicitudes();

		Helpers::concatSolicitudeWithApplicant($solicitudes);

		return response()->json([
			'solicitudes' => $solicitudes
			], 200
		);
	}

	public function listByApplicant($type)
	{
		$type = ucwords($type);
		if ( $type === 'Citizen' || $type === 'Institution' )
		{
			Helpers::longApplicant($type);

			$solicitudes = $this->solicitudeRepo->getListByApplicant($type);

			Helpers::concatSolicitudeWithApplicant($solicitudes);

			return response()->json([
				'solicitudes' => $solicitudes,
				], 200
			);
		}
		else
		{
			return response()->json([
				'error' => 'Solicitante Inválido'
				], 200
			);
		}
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateSolicitudeRequest $request)
	{

		$lastId = $this->solicitudeRepo->lastId();
		$solicitude_number = Helpers::getSolicitudeNumber($lastId);
		$request['solicitude_number'] = $solicitude_number;
		$type = $request['applicant_type'];
		Helpers::longApplicant($type);
		$request['applicant_type'] = $type;
		// dd($request->all());
		return response()->json([
			'request' => $request->all(),
			]);

		// $solicitude = $this->solicitudeRepo->lastId();
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
/*	public function edit($id)
	{
		//
	}*/

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
