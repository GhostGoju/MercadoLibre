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
			return back();
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
		if (Auth::id() !== $cart->user_id) {
			return redirect()->back()->with('error', 'No tienes permiso para eliminar este producto del carrito.');
		}
		$cart->delete();
		return redirect()->route('carts.index');
	}



	public function updateQuantity(Request $request, Cart $cart)
	{
		if (Auth::id() !== $cart->user_id) {
			return redirect()->back();
		}
		$request->validate([
			'quantity' => 'required|integer|min:1',
		]);

		$cart->quantity = $request->quantity;
		$cart->save();

		return redirect()->route('carts.index');
	}



	public function clearCart()
	{
		Cart::where('user_id', Auth::id())->delete();
		return redirect()->route('carts.index');
	}



	public function getTotal()
	{
		$total = Cart::where('user_id', Auth::id())->sum('quantity');
		return $total;
	}
}
