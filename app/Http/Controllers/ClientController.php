<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email|unique:clients',
            'phone'   => 'required',
            'address' => 'required'
        ]); 

        return Client::create($validated);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email|unique:clients,email' . $client->id,
            'phone'   => 'required',
            'address' => 'required'
        ]);

        $client->update($validated);
        return $client;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
