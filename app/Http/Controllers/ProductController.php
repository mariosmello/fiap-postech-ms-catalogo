<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\IndexProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(IndexProductRequest $request)
    {
        $products = Product::where('category_id', $request->validated('category_id'))->get();
        return response()->json($products);
    }

    public function store(CreateProductRequest $request)
    {
        $product = new Product($request->safe()->only('category_id','name', 'description', 'price'));
        $product->save();
        return response()->json($product, 201);
    }

    public function update(Product $product, CreateProductRequest $request)
    {
        $product->update($request->safe()->only('category_id','name', 'description', 'price'));
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([], 204);
    }
}
