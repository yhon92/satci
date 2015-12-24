<?php
namespace SATCI\Http\Controllers\Admin;

use SATCI\Entities\User;
use SATCI\Http\Controllers\Controller;
// use SATCI\Http\Requests;
use SATCI\Http\Requests\CreateUserRequest;
use SATCI\Http\Requests\EditUserRequest;
use SATCI\Repositories\UserRepo;
use SATCI\Services\Registrar;
use SATCI\Utils\Helpers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('jwt.auth');
		
		$this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
		
		// $this->userRepo = $userRepo;
	}

	public function findUser(Route $route)
	{
		$this->user = User::findOrFail($route->getParameter('users'));
		// $this->user = User::where('username', $route->getParameter('users'))->findOrFail();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(UserRepo $userRepo)
	{
		$users = $userRepo->getListUsers();
		$num = 0;
		
		return view('admin.users.index', compact('users', 'num'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
		// $user = new User($request->all());
		$user = User::create($request->all());
		// $user->save();

		return redirect()->route('admin.users.index');
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('admin.users.edit')->with('user', $this->user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditUserRequest $request)
	{
		Helpers::isCheck($request, 'active');

		$this->user->fill([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'active' => $request->active,
			]);

		$this->user->save();

		// return redirect()->back();
		return redirect()->route('admin.users.index');
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
		$this->user->delete();

		$message = 'El usuario ' . $this->user->full_name . ' fue eliminado';

		if ($request->ajax()) {
			return response()->json([
				'id' 			=> $this->user->id,
				'message' => $message
				]);
		}

		session()->flash('message', $message);

		return redirect()->route('admin.users.index');
	}
}
