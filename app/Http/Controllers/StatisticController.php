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
    $this->middleware('jwt.auth');
    $this->statisticRepo = $statisticRepo;
  }

  public function solicitudeByStatus(Request $request)
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

  public function solicitudeByApplicant(Request $request)
  {
    $from = $request->input('date_from');
    $to = $request->input('date_to');
    $parish = $request->input('parish');

    $data = $this->statisticRepo->countSolicitudeForApplicant($from, $to, $parish);
    
    if (empty($data)) {
      return response()->json(['error' => true], 200);
    }

    return response()->json(['succes' => true, 'data' => $data], 200);
  }

  public function solicitudeByTheme(Request $request)
  {
    $from = $request->input('date_from');
    $to = $request->input('date_to');
    $parish = $request->input('parish');
    
    $data = $this->statisticRepo->countSolicitudeForTheme($from, $to, $parish);

    if (empty($data)) {
      return response()->json(['error' => true], 200);
    }

    return response()->json(['succes' => true, 'data' => $data], 200);
  }

  public function assignedByStatus(Request $request)
  {
    $from = $request->input('date_from');
    $to = $request->input('date_to');
    $parish = $request->input('parish');
    
    $data = $this->statisticRepo->countAssignmentsForStatus($from, $to, $parish);

    if (empty($data)) {
      return response()->json(['error' => true], 200);
    }

    return response()->json(['succes' => true, 'data' => $data], 200);
  }
 }
