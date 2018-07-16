<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return response()->json($products);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->save();
        return response($product->name);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->bundle_id = 0;
        $product->save();

        return response()->json($product);
    }
}
