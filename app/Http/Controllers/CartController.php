<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{



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
		$cartItems = Cart::where('user_id', Auth::id())->get();
		return view('carts.index', ['cartItems' => $cartItems]);
	}







	public function removeFromCart(Cart $cart)
	{
		$cart->delete();
		return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito correctamente.');
	}

	public function updateQuantity(Request $request, Cart $cart)
	{
		$cart->update(['quantity' => $request->quantity]);
		return redirect()->route('cart.index')->with('success', 'Cantidad actualizada correctamente.');
	}

	public function clearCart()
	{
		Cart::where('user_id', Auth::id())->delete();
		return redirect()->route('cart.index')->with('success', 'Carrito vaciado correctamente.');
	}

	public function getTotal()
	{
		$total = Cart::where('user_id', Auth::id())->sum('quantity');
		return view('carts.total', compact('total'));
	}
}
