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
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}



	public function show($id)
	{
		$product = Product::with('file')->find($id);
		return view('ecommerces.index', compact('product'));
	}


	public function destroy(Product $product)
	{
		$product->delete();
		$this->deleteFile($product);
	}
}
