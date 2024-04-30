<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleAndpermissionSeeder;

class DatabaseSeeder extends Seeder
{

	public function run()
	{
		$this->call([
			RoleAndpermissionSeeder::class,
			UserSeeder::class,
			CategorySeeder::class
		]);

		User::factory(3)->create();
		Product::factory(180)->create();
	}
}
