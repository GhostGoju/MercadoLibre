<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SecurityTest extends TestCase
{

	//? PRUEBA DE SEGURIDAD


	use WithFaker, DatabaseTransactions;

	/**
	 *
	 * @return void
	 */
	public function testProtectedRoutesRequireAuthentication()
	{
		$protectedRoutes = [ 												//? Rutas que requieren autenticación
			'/home',
			'/users',
			'/products',
			'/categories',
			'/carts',
			'/roles',
		];

		foreach ($protectedRoutes as $route) { 								//? Realiza una solicitud GET a cada ruta protegida
			$response = $this->get($route);
			$response->assertStatus(302); 									//? Verifica que se redirija a la página de inicio de sesión
		}

		$this->printResponsePerformance($response);
	}

	/**
	 *
	 * @return void
	 */
	public function testPublicRoutesDoNotRequireAuthentication()
	{
		$publicRoutes = [ 													//? Rutas públicas que no necesitan autenticación
			'/',
			'/products/show/1',
		];

		foreach ($publicRoutes as $route) { 								//? Realiza una solicitud GET a cada ruta pública
			$response = $this->get($route);
			$response->assertStatus(200);
		}

		$this->printResponsePerformance($response);
	}

	/**
	 * @param
	 * @return void
	 */
	protected function printResponsePerformance($response)
	{
		dump('Código de estado: ' . $response->getStatusCode());
	}
}
