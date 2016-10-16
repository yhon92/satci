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

  public static function countSolicitudeForStatus($from, $to, $parish = 'all')
  {
    if ($parish === 'all' || empty($parish)) {
      
      return DB::table('solicitudes')
              ->select(DB::raw('status, count(status) as quantity'))
              ->whereBetween('reception_date', [$from, $to])
              ->groupBy('status')
              ->get();
    }

    return DB::select("select status, count(status) as quantity from solicitudes as s
      inner join (
        select id as applicant_id, text('SATCI\Entities\Citizen') as applicant_type, parish_id from citizens where parish_id = :parish_id
        union
        select id as applicant_id, text('SATCI\Entities\Institution') as applicant_type, parish_id from institutions where parish_id = :parish_id
      ) a on s.applicant_type = a.applicant_type and s.applicant_id = a.applicant_id
        where reception_date between :from and :to group by status", 
      ['parish_id' => $parish, 'from' => $from, 'to' => $to]);
  }

  /*public static function countForStatus($from, $to, $status)
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
  }*/

}