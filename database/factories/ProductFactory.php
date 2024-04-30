<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
	protected $model = Product::class;

	public function definition()
	{
		return [
			'category_id' => $this->faker->randomElement([1, 2, 3]),
			'name' => $this->faker->word(),
			'stock' => $this->faker->randomDigit(),
			'price' => $this->faker->randomDigit([10, 100]),


			'description' => $this->faker->paragraph()
		];
	}


	public function configure()
	{
		return $this->afterCreating(function (Product $product) {
			$file = new File(['route' => '/storage/images/products/default.png']);
			$product->file()->save($file);
		});
	}
}
