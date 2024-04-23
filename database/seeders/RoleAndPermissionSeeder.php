<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
	public function run()
	{
		$permissionsLibrarian = [ 				//?ADMINISTRADOR
			'products.index',
			'products.create',
			'products.store',
			'products.edit',
			'products.update',
			'products.destroy',
			'categories.index',
			'categories.get-all',
			'categories.create',
			'categories.store',
			'categories.edit',
			'categories.update',
			'categories.destroy',
			'users.index',
			'users.create',
			'users.store',
			'users.edit',
			'users.update',
			'users.destroy',
		];

		// Roles
		$admin = Role::create(['name' => 'Admin']);
		Role::create(['name' => 'User']);

		foreach ($permissionsAdmin as $permission) {
			$permission = Permission::create(['name' => $permission]);
			$admin->givePermissionTo($permission);
		}
	}
}
