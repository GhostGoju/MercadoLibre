<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{

	public function index()
	{
		$users = User::with('roles')->get();
		return view('users.index', compact('users'));
	}

	// dd($roles[1]->toArray());

	public function store(Request $request)
	{
		$user = new User($request->all());
		$user->save();
		$user->assignRole($request->role);
		return back();
	}



	public function update(UserRequest $request, User $user)
	{
		$user->update($request->all());
		$user->assignRole([$request->role]);
		return back();
	}



	public function destroy(User $user)
	{
		$user->delete();
	}
}
