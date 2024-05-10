<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
	public function run()
	{
		$permissionsAdmin = [

			//? GESTION DE PRODUCTOS
			'products.index',
			'products.create',
			'products.store',
			'products.update',
			'products.destroy',
			'products.byCategory',

			//? GESTION DE CATEGORIAS
			'categories.index',
			'categories.get-all',
			'categories.create',
			'categories.store',
			'categories.edit',
			'categories.update',
			'categories.destroy',

			//? GESTION DE USUARIOS
			'users.index',
			'users.create',
			'users.store',
			'users.edit',
			'users.update',
			'users.destroy',

			//? GESTION DE ROLES
			'roles.index',
			'roles.get-all',
			'roles.create',
			'roles.store',
			'roles.edit',
			'roles.update',
			'roles.destroy',
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
