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
		Cache::forget('users'); // QUITAR SOLO POR MOTIVO DE DESARROLLO
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
			$user = $this->userRepo->create($request->only('first_name', 'last_name', 'username', 'password', 'active'));
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
		try {
			$password = $request->get('password');

			$data = $request->only('first_name', 'last_name', 'active');
			
			if (!empty($password)) {
				$data = $request->only('first_name', 'last_name', 'password', 'active');
			} 
      
      $this->userRepo->update($id, $data);
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    Cache::forget('users');

    return response()->json(['success' => true], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->userRepo->get($id);
		$username = $user->username;

		$roles = $this->userRepo->allRoles($id);

		$permissions = $this->userRepo->allPermissions($id);

		if (count($roles) > 0 || count($permissions) > 0) {
      return response()->json(['conflict' => true], 200);
    } else {
      DB::beginTransaction();

      try {
        $this->userRepo->delete($id);
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    
    DB::commit();

    Cache::forget('users');
    Cache::forget('role_'.$username);
		Cache::forget('permissions_'.$username);

    return response()->json(['success' => true], 200);
	}
}
