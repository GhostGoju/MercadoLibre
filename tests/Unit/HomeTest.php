<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
	use RefreshDatabase;

	public function test_home()           					//? SI ES CAPAS DE TRAER ESTA VISTA DEBUELVE UN CODIGO 200
	{
		$response = $this->get('/');
		$response->assertStatus(200);
	}
}
