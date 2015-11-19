<?php
namespace SATCI\Http\Controllers\Solicitude;

use Illuminate\Http\Request;

// use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\AreaMeansRepo;
use SATCI\Repositories\AreaThemeSolicitudeRepo;

class AssignController extends Controller
{
  protected $areaMeansRepo;
  protected $assignRepo;

  public function __construct (AreaMeansRepo $areaMeansRepo, AreaThemeSolicitudeRepo $assignRepo)
  {
    $this->areaMeansRepo = $areaMeansRepo;
    $this->assignRepo = $assignRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->all();
    
    $solicitude_id = $data['solicitude'];
    
    $themes = $data['themes'];
    
    $default_means = 1;

    $ready = array();

    foreach ($themes as $theme) 
    {
      $theme_id = $theme['id'];
      $areas = $theme['areas'];

      foreach ($areas as $key => $area) 
      {
        if (array_key_exists('meansSelected', $area))
        {
          $area_means_id = $this->areaMeansRepo->getID($area['id'], $area['meansSelected']);
        }
        else
        {
          $area_means_id = $this->areaMeansRepo->getID($area['id'], $default_means);
        }

        $data = ['solicitude_id'  => $solicitude_id,
                  'theme_id'      => $theme_id,
                  'area_means_id' => $area_means_id
                ];
        $ok = $this->assignRepo->newAssign($data);

        array_push($ready, $ok);
      }
    }
    
    dd($ready);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
