<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{

	public function index()
	{
		$users = User::with('roles')->get();
		return view('users.index', compact('users'));
	}



	public function store($request)
	{
		$user = new User($request->all());
		$user->save();
	}



	public function update(UserRequest $request, User $user)
	{
		$user->update($request->all());
	}



	public function destroy(User $user)
	{
		$user->delete();
	}
}
