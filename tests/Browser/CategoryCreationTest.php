<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryCreationTest extends DuskTestCase
{
	use DatabaseMigrations;

	public function testCategoryCreation()
	{
		$this->browse(function (Browser $browser) {
			$browser->visit('/categories')
				->click('@create-category-button')
				->type('name', 'Nueva Categoría')
				->press('Guardar')
				->assertPathIs('/categories')
				->assertSee('Nueva Categoría');
		});
	}
}
