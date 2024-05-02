<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


	use UploadFile;


	public function addToCart(Request $request)
	{

		if (Auth::check()) {
			$productId = $request->input('product_id');
			$quantity = $request->input('quantity');

			$product = Product::findOrFail($productId);

			$cart = Cart::where('user_id', Auth::id())
				->where('product_id', $productId)
				->first();

			if ($cart) {
				$cart->quantity += $quantity;
				$cart->save();
			} else {

				Cart::create([
					'user_id' => Auth::id(),
					'product_id' => $productId,
					'quantity' => $quantity,
				]);
			}

			return redirect()->route('carts.index');
		} else {
			return redirect()->route('login');
		}
	}



	public function index()
	{
		$cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
		return view('carts.index', compact('cartItems'));
	}




	public function removeFromCart(Cart $cart)
	{
	}



	public function updateQuantity(Request $request, Cart $cart)
	{
	}



	public function clearCart()
	{
	}



	public function getTotal()
	{
	}
}
