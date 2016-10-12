<?php

namespace SATCI\Http\Controllers;

use Illuminate\Http\Request;

use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\StatisticRepo;

class StatisticController extends Controller
{
  protected $statisticRepo;

  public function __construct (StatisticRepo $statisticRepo)
  {
    $this->statisticRepo = $statisticRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = $this->statisticRepo->countForStatus_2();

    return response()->json($data, 200);
  }

  public function allByStatus(Request $request)
  {
    $data = $request->all();
    $type = $data['type'];
    $from = $data['date_from'];
    $to = $data['date_to'];
    
    $data = $this->statisticRepo->countSolicitudeForStatus($from, $to);

    if (empty($data)) {
      return response()->json(['error' => true], 200);
    }

    return response()->json(['succes' => true, 'data' => $data], 200);
  }

  public function allByApplicant()
  {
    $citizen = $this->statisticRepo->countForApplicant('Citizen');

    $institution = $this->statisticRepo->countForApplicant('Institution');

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
