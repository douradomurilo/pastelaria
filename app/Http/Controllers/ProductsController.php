<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();
        
        return response()->json($products);
    }

     public function create(Request $request): JsonResponse
     {
        $product = new Product;

        $product->code = $request->code;
        $product->name = $request->name;
        $product->photo = $request->file('photo')->move('img/products', $request->file('photo')->getClientOriginalName());
        $product->price = $request->price;
        $product->type = $request->type;

        $product->save();

        return response()->json($product, 201);
     }

     public function show($id): JsonResponse
     {
        $product = Product::find($id);

        return response()->json($product);
     }

     public function update(Request $request, $id): JsonResponse
     { 
        $product = Product::find($id);
        
        $product->code = $request->input('code');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->photo = $request->input('photo');
        $product->type = $request->input('type');
        
        $product->save();

        return response()->json($product);
     }

     public function destroy($id): JsonResponse
     {
        $product = Product::find($id);
        $product->delete();

        return response()->json('Produto removido com sucesso');
     }
}