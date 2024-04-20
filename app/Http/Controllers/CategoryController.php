<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function create(CreateCategoryRequest $request)
    {
        $category = new Category($request->only('name', 'description'));
        $category->save();
        return response()->json($category, 201);
    }
}
