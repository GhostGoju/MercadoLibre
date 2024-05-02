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


	public function store(Request $request)
	{
		$role = new Role($request->all());
		$role->save();
	}



	public function update($request, Role $role)
	{
		$role->update($request->all());
	}



	public function getAll()
	{
		$roles = Role::query();
	}



	public function show(Role $role)
	{
		$roles = Role::query();
	}



	public function destroy(Role $role)
	{
		$role->delete();
	}
}
