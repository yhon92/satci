<?php
namespace SATCI\Http\Controllers\Auth;

use SATCI\Http\Controllers\Controller;
// use SATCI\Http\Requests\Request;
use SATCI\Entities\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Request;

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
			return response()->json(['token_expired']. $e->getStatusCode());
		} catch (TokenInvalidException $e) {
			return response()->json(['token_invalid'], $e->getStatusCode());
		}	catch (JWTException $e) {
			return response()->json(['token_absent'], $e->getStatusCode());
		}
        //The token is valid and we have found the user via the sub claim
		return response()->json(compact('user'));
	}

	public function login(Request $request)
	{
		$credentials = $request->only('username', 'password');

		try {
      // verify the credentials and create a token for the user
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['error' => trans('validation.active_user')], 401);
			}
		} catch (JWTException $e) {
      // something went wrong
			return response()->json(['error' => 'could_not_create_token'], 500);
		}
    // if no errors are encountered we can return a JWT
		return response()->json(compact('token'));
	}

}
