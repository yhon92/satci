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

  public static function countSolicitudeForStatus($from, $to, $parish = 'all')
  {
    if ($parish === 'all' || empty($parish)) {
      
      return DB::table('solicitudes')
              ->select(DB::raw('status, count(status) as quantity'))
              ->whereBetween('reception_date', [$from, $to])
              ->groupBy('status')
              ->get();
    }

    return DB::select("select status, count(status) as quantity from solicitudes as ts
      inner join (
        select id as applicant_id, text('SATCI\Entities\Citizen') as applicant_type, parish_id 
          from citizens where parish_id = :parish_id
        union
        select id as applicant_id, text('SATCI\Entities\Institution') as applicant_type, parish_id 
          from institutions where parish_id = :parish_id
      ) a on ts.applicant_type = a.applicant_type and ts.applicant_id = a.applicant_id
        where reception_date between :from and :to group by status", 
      ['parish_id' => $parish, 'from' => $from, 'to' => $to]);
  }

  public static function countForApplicant($from, $to, $parish = 'all')
  {
    if ($parish === 'all' || empty($parish)) {
      
      return DB::select("select 
        case ts.applicant_type 
          when 'SATCI\Entities\Citizen' then 'Personal'
          when 'SATCI\Entities\Institution' then 'Institución'
        end as applicant,
        count(*) as quantity
        from solicitudes as ts
        where ts.reception_date between :from and :to
        group by applicant", 
        ['from' => $from, 'to' => $to]);
    }
     
    return DB::select("select 
      case ts.applicant_type 
        when 'SATCI\Entities\Citizen' then 'Personal'
        when 'SATCI\Entities\Institution' then 'Institución'
      end as applicant,
      count(*) as quantity
      from solicitudes as ts
      inner join (
        select id as applicant_id, text('SATCI\Entities\Citizen') as applicant_type, parish_id 
          from citizens where parish_id = :parish_id
        union
        select id as applicant_id, text('SATCI\Entities\Institution') as applicant_type, parish_id 
          from institutions where parish_id = :parish_id
      ) a on ts.applicant_type = a.applicant_type and ts.applicant_id = a.applicant_id
      where ts.reception_date between :from and :to
      group by applicant", 
      ['parish_id' => $parish, 'from' => $from, 'to' => $to]);
  }

  public static function countSolicitudeForTheme($from, $to, $parish = 'all')
  {
    if ($parish === 'all' || empty($parish)) {
      
      return DB::select("select tt.name as theme, count(a.theme_id) as quantity 
        from (
          select distinct solicitude_id, theme_id from assign_solicitudes tas
          inner join solicitudes ts on tas.solicitude_id = ts.id
          where ts.reception_date between :from and :to
        ) a 
        inner join themes tt on a.theme_id = tt.id 
        group by name, theme_id order by name", 
        ['from' => $from, 'to' => $to]);
    }

    return DB::select("select tt.name as theme, count(ass.theme_id) as quantity 
      from (
        select distinct tas.solicitude_id, tas.theme_id from assign_solicitudes as tas
        inner join (
          select ts.id as solicitude_id from solicitudes as ts
          inner join (
            select id as applicant_id, text('SATCI\Entities\Citizen') as applicant_type, parish_id 
              from citizens where parish_id = :parish_id
            union
            select id as applicant_id, text('SATCI\Entities\Institution') as applicant_type, parish_id 
              from institutions where parish_id = :parish_id
            ) a on ts.applicant_type = a.applicant_type and ts.applicant_id = a.applicant_id
          where reception_date between :from and :to
        ) so on tas.solicitude_id = so.solicitude_id
      ) ass 
      inner join themes tt on ass.theme_id = tt.id 
      group by name, theme_id order by theme", 
    ['parish_id' => $parish, 'from' => $from, 'to' => $to]);
  }

}