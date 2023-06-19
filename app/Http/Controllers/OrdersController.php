<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::all();
        
        return response()->json($orders);
    }

    public function create(Request $request): JsonResponse
    {
        $order = new Order;

        $order->client_id = $request->client_id;
        $order->note = $request->note;
        
        $order->save();

        return response()->json($order, 201);
    }

    public function show($id): JsonResponse
    {
        $order = Order::find($id);

        return response()->json($order);
    }

    public function update(Request $request, $id): JsonResponse
    { 
        $order = Order::find($id);
        
        $order->note = $request->input('note');
                
        $order->save();

        return response()->json($order);
    }

    public function destroy($id): JsonResponse
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json('Pedido removido com sucesso');
    }

    public function addProduct(Request $request, $id): JsonResponse
    {
        $order = Order::find($id);
        
        $productId = $request->input('product_id');
        $order->products()->attach($productId);

        return response()->json("Produto #{$productId} adicionado ao pedido #{$id}");
    }

    public function removeProduct(Request $request, $id): JsonResponse
    {
        $order = Order::find($id);
        
        $productId = $request->input('product_id');
        $order->products()->detach($productId);

        return response()->json("Produto #{$productId} removido do pedido #{$id}");
    }
}