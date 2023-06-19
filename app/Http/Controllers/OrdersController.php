<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::all();
        
        return response()->json($orders);
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'exists:clients,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $order = new Order;

        $order->client_id = $request->client_id;
        $order->note = $request->note;
        
        $order->save();

        return response()->json($order, 201);
    }

    public function show($id): JsonResponse
    {
        $order = Order::findOrFail($id);

        return response()->json($order);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $order = Order::findOrFail($id);
        
        $order->note = $request->input('note');
                
        $order->save();

        return response()->json($order);
    }

    public function destroy($id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json('Pedido removido com sucesso');
    }

    public function addProduct(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $order = Order::findOrFail($id);
        
        $productId = $request->input('product_id');
        $order->products()->attach($productId);

        return response()->json("Produto #{$productId} adicionado ao pedido #{$id}");
    }

    public function removeProduct(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }
        $order = Order::findOrFail($id);
        
        $productId = $request->input('product_id');
        $order->products()->detach($productId);

        return response()->json("Produto #{$productId} removido do pedido #{$id}");
    }

    public function sendMail($id): JsonResponse
    {
        $order = Order::findOrFail($id);

        $client = Client::findOrFail($order->client_id);
 
        Mail::to($client->email)->send(new NewOrder($order));

        return response()->json("E-mail enviado para o cliente #{$client->id}. Pedido #{$id}");
    }
}