<?php 
namespace SATCI\Http\Controllers;

use Illuminate\Http\Request;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\ParishRepo;


class ParishController extends Controller
{

  protected $parishRepo;

  public function __construct (ParishRepo $parishRepo)
  {
    // $this->middleware('jwt.auth');
    $this->parishRepo = $parishRepo;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $parishes = $this->parishRepo->getListParishes();

    return response()->json(['parishes' => $parishes], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    //
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
