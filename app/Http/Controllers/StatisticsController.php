<?php

namespace SATCI\Http\Controllers;

use Illuminate\Http\Request;

use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\StatisticsRepo;

class StatisticsController extends Controller
{
  protected $statisticsRepo;

  public function __construct (StatisticsRepo $statisticsRepo)
  {
    $this->statisticsRepo = $statisticsRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = $this->statisticsRepo->countForStatus_2();

    return response()->json($data, 200);
  }

  public function allByStatus(Request $request)
  {
    $data = $request->all();
    $type = $data['type'];
    $from = $data['date_from'];
    $to = $data['date_to'];
    
    $data = $this->statisticsRepo->countSolicitudeForStatus($from, $to);

    if (empty($data)) {
      return response()->json(['error' => true], 200);
    }

    return response()->json(['succes' => true, 'data' => $data], 200);
  }

  public function allByApplicant()
  {
    $citizen = $this->statisticsRepo->countForApplicant('Citizen');

    $institution = $this->statisticsRepo->countForApplicant('Institution');

    $data = [
      [
        'key' => 'Personal',
        'y' => $citizen
      ],
      [
        'key' =>'Institución',
        'y' => $institution
      ],
    ];
    return response()->json(['succes' => true, 'data' => $data], 200);
  }

 }
