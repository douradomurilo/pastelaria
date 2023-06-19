<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class ProductsController extends Controller
{
   public function index(): JsonResponse
   {
      $products = Product::all();
      
      return response()->json($products);
   }

   public function create(Request $request): JsonResponse
   {
      $validator = Validator::make($request->all(), [
         'code' => 'required|unique:products',
         'name' => 'required',
         'photo' => 'required',
         'price' => 'required',
         'type' => ['required', new Enum(ProductType::class)]
      ]);

      if ($validator->fails()) {
         return response()->json($validator->messages());
      }

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
      $product = Product::findOrFail($id);

      return response()->json($product);
   }

   public function update(Request $request, $id): JsonResponse
   {
      $validator = Validator::make($request->all(), [
         'name' => 'required',
         'photo' => 'required',
         'price' => 'required',
         'type' => ['required', new Enum(ProductType::class)]
      ]);

      if ($validator->fails()) {
         return response()->json($validator->messages());
      }

      $product = Product::findOrFail($id);
      
      $product->name = $request->input('name');
      $product->price = $request->input('price');
      $product->photo = $request->input('photo');
      $product->type = $request->input('type');
      
      $product->save();

      return response()->json($product);
   }

   public function destroy($id): JsonResponse
   {
      $product = Product::findOrFail($id);
      $product->delete();

      return response()->json(['success' => 'Produto removido com sucesso'], 410);
   }
}