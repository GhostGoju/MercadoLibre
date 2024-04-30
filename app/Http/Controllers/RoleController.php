<?php

namespace App\Http\Controllers;


use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

	public function index(Request $request)
	{
		$roles = Role::get();
		if (!$request->ajax()) return view('roles.index', compact('roles'));
		return response()->json(['roles' => $roles], 200);
	}


	public function getAll()
	{
		$roles = Role::query();
		// dd($roles[1]->toArray());
		return response()->json(['roles' => $roles], 200);
	}
}
