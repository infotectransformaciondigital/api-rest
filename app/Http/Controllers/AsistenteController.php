<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use Illuminate\Http\Request;

class AsistenteController extends Controller
{
    public function index()
    {
        return Asistente::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email|unique:asistentes',
            'telefono' => 'required|string',
            'evento_id' => 'required|exists:eventos,id',
        ]);

        return Asistente::create($validated);
    }

    public function show($id)
    {
        return Asistente::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $asistente = Asistente::findOrFail($id);
        $asistente->update($request->all());
        return $asistente;
    }

    public function destroy($id)
    {
        Asistente::destroy($id);
        return response()->json(null, 204);
    }
}
