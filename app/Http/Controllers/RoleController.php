<?php

namespace App\Http\Controllers;


use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

	// public function index()
	// {
	// 	$roles = Role::get();
	// 	if (!$request->ajax()) return view('roles.index', compact('roles'));
	// 	return response()->json(['categories' => $roles], 200);
	// }


	public function getAll()
	{
		$roles = Role::all();
		return response()->json(['roles' => $roles], 200);
	}
}
