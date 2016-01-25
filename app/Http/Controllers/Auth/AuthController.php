<?php
namespace SATCI\Http\Controllers\Auth;

use Auth;
use Cache;
use ErrorException;
use Illuminate\Http\Request;
use Johnnymn\Sim\Roles\Models\Permission;
use Johnnymn\Sim\Roles\Models\Role;
use JWTAuth;
use SATCI\Entities\User;
use SATCI\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	public function __construct()
	{
		$this->middleware('jwt.auth', ['except' => ['login']]);
	}

	public function index()
	{
		return "<h1>HOLA</h1>";
	}

	public function login(Request $request)
	{
		$credentials = $request->only('username', 'password');

		try {
      // verify the credentials and create a token for the user
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['error' => trans('validation.invalid_user')], 401);
			} elseif (!Auth::user()->active) {
				Auth::logout();
				return response()->json(['error' => trans('validation.active_user')], 401);
			}
		} catch (JWTException $e) {
      // something went wrong
			return response()->json(['error' => 'could_not_create_token'], 500);
		}
    // if no errors are encountered we can return a JWT
		return response()->json(compact('token'), 200);
	}

	/**
   * Determine if user is authenticate by locating token
   */
	public function user()
	{
		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				return response()->json(['user_not_found'], 404);
			}
		} catch (TokenExpiredException $e) {
			return response()->json(['token_expired'], $e->getStatusCode());
		} catch (TokenInvalidException $e) {
			return response()->json(['token_invalid'], $e->getStatusCode());
		}	catch (JWTException $e) {
			return response()->json(['token_absent'], $e->getStatusCode());
		}


    //The token is valid and we have found the user via the sub claim
		return response()->json(compact('user'));
	}

	public function permissions()
	{
		$user = Auth::user()->username;
		// Cache::flush();
		if (!Cache::has('role_'.$user) || !Cache::has('permissions_'.$user)) {
			try {
				$getRole = Auth::user()->getRoles();	
				$role = $getRole[0]->slug;

				$getPermissions = Auth::user()->getPermissions();
				$permissions = [];

				foreach ($getPermissions as $key => $value) {
					array_push($permissions, $value->slug);
				}
				Cache::forever('role_'.$user, $role);
				Cache::forever('permissions_'.$user, $permissions);

			} catch (ErrorException $e) {
				Auth::logout();
				return response()->json(['error' => trans('validation.permissions_user')], 401);
			}
		} else {
			$role = Cache::get('role_'.$user);
			$permissions = Cache::get('permissions_'.$user);
		}

		return response()->json(['acl' => [$role => $permissions]], 200);
	}

}
