<?php 

namespace SATCI\Repositories;

use Illuminate\Support\Facades\DB;
use SATCI\Entities\Solicitude;

class StatisticRepo
{
  public static function countTotal()
  {
    return Solicitude::count();
  }

  public static function countForApplicant($applicant)
  {
    return Solicitude::where('applicant_type', 'SATCI\\Entities\\'.$applicant)->count();
  }

  public static function countSolicitudeForStatus($from, $to)
  {
    return DB::table('solicitudes')
            ->select(DB::raw('status as key, count(status) as y'))
            ->whereBetween('reception_date', [$from, $to])
            ->groupBy('status')
            ->get();
  }

  public static function countForStatus($from, $to, $status)
  {
    return Solicitude::whereBetween('reception_date', [$from, $to])
                    ->where('status', $status)
                    ->count();
  }

  public static function countForStatus_2()
  {
    return DB::table('solicitudes')
            ->select(DB::raw('status as key, count(status) as y'))
            ->groupBy('status')
            ->get();
  }

}