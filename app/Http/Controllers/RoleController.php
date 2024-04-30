<?php

namespace App\Http\Controllers;


use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

	public function index($request)
	{
		$roles = Role::get();
		if (!$request->ajax()) return view('roles.index', compact('roles'));
		return response()->json(['roles' => $roles], 200);
	}


	public function getAll()
	{
		$roles = Role::all();
		// dd($roles[1]->toArray());
		return response()->json(['roles' => $roles], 200);
	}
}
