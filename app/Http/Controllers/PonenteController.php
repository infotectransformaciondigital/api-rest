<?php

namespace App\Http\Controllers;

use App\Models\Ponente;
use Illuminate\Http\Request;

class PonenteController extends Controller
{
    public function index()
    {
        return Ponente::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'biografia' => 'required|string',
            'especialidad' => 'required|string',
        ]);

        return Ponente::create($validated);
    }

    public function show($id)
    {
        return Ponente::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $ponente = Ponente::findOrFail($id);
        $ponente->update($request->all());
        return $ponente;
    }

    public function destroy($id)
    {
        Ponente::destroy($id);
        return response()->json(null, 204);
    }
}
