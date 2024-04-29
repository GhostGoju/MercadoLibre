<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{

	public function index(Request $request)
	{
		$users = User::get();
		return view('users.index', compact('users'));
	}



	public function store(Request $request)
	{
		$user = new User($request->all());
		$user->save();
		$user->assignRole($request->role);
		if (!$request->ajax()) return back();
	}



	public function update(UserRequest $request, User $user)
	{
		$user->update($request->all());
		$user->syncRoles([$request->role]);
		if (!$request->ajax()) return back();
	}



	public function destroy($request, User $user)
	{
		$user->delete();
		if (!$request->ajax()) return back();
	}
}
