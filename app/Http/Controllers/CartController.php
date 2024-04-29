<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

	public function addToCart(Product $product)
	{
	}


	public function index()
	{
		Cart::get();
		return view('carts.index');
	}
}
