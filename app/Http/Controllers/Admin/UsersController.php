<?php namespace SATCI\Http\Controllers\Admin;

use SATCI\Entities\User;
use SATCI\Repositories\UserRepo;
use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Services\Registrar;
use SATCI\Utils\Helpers;
use SATCI\Http\Requests\CreateUserRequest;

use Illuminate\Http\Request;

class UsersController extends Controller {

	protected $userRepo;

	public function __construct(UserRepo $userRepo)
	{
		// $this->middleware('auth');
		$this->userRepo = $userRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->userRepo->getListUsers();
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
		return view('auth.register');
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
		$user = User::findOrFail($id);

		return view('admin.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);

		Helpers::isCheck($request, 'active');

		// dd($request->active);

		$user->fill($request->all());
		$user->save();

		// return redirect()->back();
		return redirect()->route('admin.users.index');
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
