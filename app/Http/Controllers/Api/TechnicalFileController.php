<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TechnicalFile;
use Illuminate\Http\Request;

class TechnicalFileController extends Controller
{
    public function index()
    {
        return response()->json(TechnicalFile::all());
    }

    public function store(Request $request)
    {
        $file = TechnicalFile::create($request->all());
        return response()->json($file, 201);
    }

    public function show(TechnicalFile $technicalFile)
    {
        return response()->json($technicalFile);
    }

    public function update(Request $request, TechnicalFile $technicalFile)
    {
        $technicalFile->update($request->all());
        return response()->json($technicalFile);
    }

    public function destroy(TechnicalFile $technicalFile)
    {
        $technicalFile->delete();
        return response()->json(null, 204);
    }
}
