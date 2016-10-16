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
    $from = $request->input('date_from');
    $to = $request->input('date_to');
    $parish = $request->input('parish');
    
    $data = $this->statisticRepo->countSolicitudeForStatus($from, $to, $parish);

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
        'applicant' => 'Personal',
        'quantity' => $citizen
      ],
      [
        'applicant' =>'Institución',
        'quantity' => $institution
      ],
    ];
    return response()->json(['succes' => true, 'data' => $data], 200);
  }

 }
