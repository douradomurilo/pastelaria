<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(): JsonResponse
    {
        $clients = Client::all();
        
        return response()->json($clients);
    }

     public function create(Request $request): JsonResponse
     {
        $client = new client;

        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->birthdate = $request->birthdate;
        $client->address = $request->address;
        $client->address_complement = $request->address_complement;
        $client->district = $request->district;
        $client->zipcode = $request->zipcode;
        $client->code = $request->code;

        $client->save();

        return response()->json($client, 201);
     }

     public function show($id): JsonResponse
     {
        $client = Client::find($id);

        return response()->json($client);
     }

     public function update(Request $request, $id): JsonResponse
     { 
        $client = Client::find($id);
        
        $client->name = $request->input('name');
        $client->phone = $request->input('phone');
        $client->phone = $request->input('email');
        $client->birthdate = $request->input('birthdate');
        $client->address = $request->input('address');
        $client->address_complement = $request->input('address_complement');
        $client->district = $request->input('district');
        $client->zipcode = $request->input('zipcode');
        $client->code = $request->input('code');
        
        $client->save();

        return response()->json($client);
     }

     public function destroy($id): JsonResponse
     {
        $client = Client::find($id);
        $client->delete();

        return response()->json('Cliente removido com sucesso');
     }
}