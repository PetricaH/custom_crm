<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function index($clientId)
    {
        // Return interactions for a given client
        $interactions = Interaction::where('client_id', $clientId)->get();
        return response()->json($interactions);
    }

    public function store(Request $request, $clientId)
    {
        $data = $request->all();
        $data['client_id'] = $clientId;
        $interaction = Interaction::create($data);
        return response()->json($interaction, 201);
    }

    public function show($clientId, Interaction $interaction)
    {
        return response()->json($interaction);
    }

    public function update(Request $request, $clientId, Interaction $interaction)
    {
        $interaction->update($request->all());
        return response()->json($interaction);
    }

    public function destroy($clientId, Interaction $interaction)
    {
        $interaction->delete();
        return response()->json(null, 204);
    }
}
