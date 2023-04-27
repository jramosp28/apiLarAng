<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'last_name2' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:clients,email',
                'phone' => 'required|string|max:10',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'date' => 'required|string|max:25',
                'bike' => 'required|boolean',
                'bike_model' => 'required|string|max:255',
            ]);

            $client = new Client($validated);
            $client->save();

            return response()->json([
                'message' => 'Client created successfully',
                'data' => $client,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);

        return response()->json($client);
    }

    public function show(string $id)
    {
        $client = Client::find($id);

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'last_name' => 'sometimes|required|string|max:255',
                'last_name2' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:clients,email,'.$client->id,
                'phone' => 'sometimes|required|string|max:10',
                'address' => 'sometimes|required|string|max:255',
                'city' => 'sometimes|required|string|max:255',
                'date' => 'sometimes|required|string|max:25',
                'bike' => 'sometimes|required|boolean',
                'bike_model' => 'sometimes|required|string|max:255',
            ]);

            $client->update($validated);

            return response()->json([
                'message' => 'Client updated successfully',
                'data' => $client,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente.'
        ]);
    }
}