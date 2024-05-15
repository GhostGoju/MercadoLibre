<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{


	//? PRUEBA UNITARIA Y DE ACEPTACION


	use WithFaker, DatabaseTransactions;



	public function test_home()           					//? SI TRAER ESTA VISTA DEBUELVE UN CODIGO 200
	{
		$response = $this->get('/');
		$response->assertStatus(200);
		$this->printResponsePerformance($response);
	}


	protected function printResponsePerformance($response) 						//? IMPRIME LA INFORMACION DE FORMA MAS CLARA
	{
		dump('Código de estado: ' . $response->getStatusCode());
		dump('Prueba unitaria exitosa');
	}
}
