<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryRequest;

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
	}



	public function update(CategoryRequest $request, Category $category)
	{
		$category->update($request->all());
	}



	public function getAll()
	{
		$categories = Category::query();
	}



	public function show(Category $category)
	{
		$categories = Category::query();
	}



	public function destroy(Category $category)
	{
		$category->delete();
	}
}
