<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

	public function run()
	{
		$user = new user(
			[
				'name' => 'Julian',
				'last_name' => 'Becerra',
				'email' => 'julian1234@gmail.com',
				'password' => '123456789',
				'remember_token' => Str::random(30),
			]
		);
		$user->save();
		$user->assignRole('Admin');
	}
}
