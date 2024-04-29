<?php

namespace App\Http\Controllers;

use App\Models\Product;

class EcommerceController extends Controller
{

	public function index()
	{
		$products = Product::with('category', 'file')
			->whereHas('category')
			->get();

		return view('ecommerces.index', compact('products'));
	}
}
