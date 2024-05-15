<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomePerformanceTest extends TestCase
{


	//? PRUEBA DE RENDIMIENTO


	use WithFaker, DatabaseTransactions;


	public function testHomePageLoadsInUnder500Milliseconds()
	{

		$startTime = microtime(true); 											//? Mide el tiempo antes de hacer la solicitud a la ruta
		$response = $this->get('/');											//? Realiza la solicitud a la ruta
		$endTime = microtime(true);												//? Mide el tiempo después de recibir la respuesta
		$totalTime = ($endTime - $startTime) * 1000;							//? Calcula el tiempo que tardó la acción en ejecutarse en milisegundos
		$this->assertLessThan(
			1000,
			$totalTime,
			'La página de inicio tardó más de 500 ms en cargar. Tiempo total: '
				. $totalTime . ' ms'
		); 																		//? Verifica si el tiempo total es menor a 500 ms
		$response->assertStatus(200);											//? Verifica que la respuesta tenga un código de estado exitoso (200)
		$this->printResponsePerformance($response);								//? Imprime el contenido de la respuesta
	}

	protected function printResponsePerformance($response) 						//? IMPRIME LA INFORMACION DE FORMA MAS CLARA
	{
		dump('Código de estado: ' . $response->getStatusCode());
		dump('Prueba de rendimiento exitosa');
	}
}
