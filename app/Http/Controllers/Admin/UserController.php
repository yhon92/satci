<?php
namespace SATCI\Http\Controllers\Admin;

use Cache;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateUserRequest;
use SATCI\Http\Requests\EditUserRequest;
use SATCI\Repositories\UserRepo;
// use SATCI\Utils\Helpers;

class UserController extends Controller
{
	protected $userRepo;
	
	public function __construct(UserRepo $userRepo)
	{
		// $this->middleware('jwt.auth');
		$this->userRepo = $userRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		Cache::forget('users');
		if (!Cache::has('users')) {
      $users = $this->userRepo->all();

      Cache::forever('users', $users);
    } else {
      $users = Cache::get('users');
    }
    
    return response()->json(['users' => $users], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
		DB::beginTransaction();
		try {
			$user = $this->userRepo->create($request->all());
		} catch (QueryException $e) {
      DB::rollBack();
      
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    DB::commit();

    Cache::forget('users');

    $user = $this->userRepo->get($user->id);

		return response()->json(['success' => true, 'user' => $user], 200);
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
	public function update($id, EditUserRequest $request)
	{
		// Helpers::isCheck($request, 'active');

		// $this->user->fill([
		// 	'first_name' => $request->first_name,
		// 	'last_name' => $request->last_name,
		// 	'active' => $request->active,
		// 	]);

		// $this->user->save();

		// return redirect()->back();
		// return redirect()->route('admin.users.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		// User::destroy($id);
		// $this->user->delete();

		// $message = 'El usuario ' . $this->user->full_name . ' fue eliminado';

		// if ($request->ajax()) {
		// 	return response()->json([
		// 		'id' 			=> $this->user->id,
		// 		'message' => $message
		// 		]);
		// }

		// session()->flash('message', $message);

		// return redirect()->route('admin.users.index');
	}
}
