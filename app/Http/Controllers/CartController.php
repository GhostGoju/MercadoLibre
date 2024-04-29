<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

	public function addToCart(Request $request)
	{
		$productId = $request->input('product_id');
		$userId = auth()->id();

		Cart::create([
			'user_id' => $userId,
			'product_id' => $productId,
			'quantity' => 1,
		]);
		// return
	}
}
