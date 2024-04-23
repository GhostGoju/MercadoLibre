<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

	public function run()
	{
		Category::create(['name' => 'Hogar']);
		Category::create(['name' => 'Deportes']);
		Category::create(['name' => 'Tecnologia']);
	}
}
