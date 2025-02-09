<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();

        // Filter by client code (partial match)
        if ($request->filled('client_code')) {
            $query->where('client_code', 'like', '%'.$request->client_code.'%');
        }

        // Filter by salesperson_id (exact match)
        if ($request->filled('salesperson_id')) {
            $query->where('salesperson_id', $request->salesperson_id);
        }

        // Additional filters can be applied here

        return response()->json($query->get());
    }

    /**
     * Store a newly created client.
     *
     * Expects the following optional inputs:
     * - person_of_contact_name
     * - business_name
     * - business_phone
     * - person_of_contact_phone
     * - additional_details
     *
     * At least one field must be provided.
     */
    public function store(Request $request)
    {
        // Grab only the fields that are relevant for client creation
        $data = $request->only([
            'person_of_contact_name',
            'business_name',
            'business_phone',
            'person_of_contact_phone',
            'additional_details'
        ]);

        // Check that at least one input is provided
        if (
            empty($data['person_of_contact_name']) &&
            empty($data['business_name']) &&
            empty($data['business_phone']) &&
            empty($data['person_of_contact_phone']) &&
            empty($data['additional_details'])
        ) {
            return response()->json([
                'message' => 'At least one field must be provided.'
            ], 422);
        }

        // Determine what to store as the "name" of the client:
        // Prefer business_name; if not provided, fall back to person_of_contact_name
        $name = $data['business_name'] ?? $data['person_of_contact_name'] ?? null;

        // Build the contact_info array
        $contact_info = [
            'person_of_contact_name' => $data['person_of_contact_name'] ?? null,
            'business_phone'         => $data['business_phone'] ?? null,
            'person_of_contact_phone'=> $data['person_of_contact_phone'] ?? null,
        ];

        // Prepare the final data array for creation
        $clientData = [
            'name'               => $name,
            'contact_info'       => $contact_info,
            'additional_details' => $data['additional_details'] ?? null,
        ];

        // Create and return the client
        $client = Client::create($clientData);
        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        return response()->json($client);
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }
}
