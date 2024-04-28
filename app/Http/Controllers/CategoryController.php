<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{




	public function index(Request $request)
	{
		$categories = Category::get();
		if (!$request->ajax()) return view('categories.index', compact('categories'));
		return response()->json(['categories' => $categories], 200);
	}

	public function store(Request $request)
	{
		$category = new Category($request->all());
		$category->save();
		return response()->json([], 200);
	}

	public function show(Category $category)
	{
		return response()->json(['category' => $category], 200);
	}

	public function update($request, $id)
	{
		//
	}

	public function destroy(Category $category)
	{
		$category->delete();
		return response()->json([], 204);
	}
}
