<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
	protected $model = User::class;

	public function definition()
	{
		return [
			'name' => fake()->name(),
			'last_name' => fake()->lastName(),
			'email' => fake()->unique()->safeEmail(),
			'password' => Hash::make('123456789'),
			'remember_token' => Str::random(10),
		];
	}

	public function configure()
	{
		return $this->afterCreating(function (User $user) {
			$user->assignRole('User');
		});
	}
}
