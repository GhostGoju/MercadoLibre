<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCreationTest extends TestCase
{
	use WithFaker, DatabaseTransactions; 												//? DatabaseTransactions se borra de aqui si quiero ver como quedo insertado el registro

	/** @test */
	public function it_can_create_a_user()
	{
		$password = '123456789';

		$userData = [ 																	//? Esta estructura se toma del modelo o de factories
			'name' => 'pruebaaaaa',
			'last_name' => $this->faker->lastName(),
			'email' => $this->faker->unique()->safeEmail(),
			'password' => $password,
			'password_confirmation' => $password,
		];

		$response = $this->post('/register', $userData);

		$response->assertStatus(302); 													//? Verifica que la creación del usuario sea exitosa (redirección HTTP 302)
		$this->assertDatabaseHas('users', ['email' => $userData['email']]); 			//? Verifica que el usuario exista en la base de datos

		//? También se puede verificar cualquier otro aspecto del usuario creado, como sus roles
		$createdUser = User::where('email', $userData['email'])->first();
		$this->assertEquals('User', $createdUser->roles->first()->name); 				//? Verifica que el usuario tenga el rol 'User'
		$this->printResponsePerformance($response);
	}


	protected function printResponsePerformance($response) 						//? IMPRIME LA INFORMACION DE FORMA MAS CLARA
	{
		dump('Código de estado: ' . $response->getStatusCode());
		dump('Registro de usuario exitoso');
	}
}
