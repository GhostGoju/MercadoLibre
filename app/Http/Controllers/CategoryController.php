<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
	public function index(Request $request)
	{
		$categories = Category::get();
		return view('categories.index', compact('categories'));
	}

	public function store(Request $request)
	{
		$category = new Category($request->all());
		$category->save();
	}

	public function getAll()
	{
		$categories = Category::query();
		return DataTables::of($categories)->toJson();
	}


	public function show(Category $category)
	{
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy(Category $category)
	{
		$category->delete();
	}
}
