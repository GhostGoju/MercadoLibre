<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
	use UploadFile;

	public function home()
	{
		$products = Product::with('category', 'file')
			->whereHas('category')
			->where('stock', '>', 0)
			->get();

		return view('index', compact('products'));
	}

	public function index()
	{
		$products = Product::with('category', 'file')->whereHas('category')->get();
		return view('products.index', compact('products'));
	}

	public function store(ProductRequest $request)
	{
		try {
			DB::beginTransaction();
			$product = new Product($request->all());
			$product->save();
			$this->uploadFile($product, $request);
			DB::commit();
			return redirect()->route('products.index')->with('success', 'Producto creado/actualizado correctamente');
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function update(ProductUpdateRequest $request, Product $product)
	{
		try {
			DB::beginTransaction();
			$product->update($request->all());
			$this->uploadFile($product, $request);
			DB::commit();
			return redirect()->route('products.index')->with('success', 'Producto creado/actualizado correctamente');
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}


	public function show(Product $product)
	{
		return response()->json(['product' => $product], 200);
	}

	public function destroy(Product $product)
	{
		$product->delete();
		$this->deleteFile($product);
		return response()->json([], 204);
	}
}
