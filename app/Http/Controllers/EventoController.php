<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    // Mostrar todos los eventos
    public function index()
    {
        return response()->json(Evento::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos que llegan en la petición
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'ubicacion' => 'required|string|max:255',
        ]);

        // 2. Crear el nuevo evento en la base de datos
        $evento = Evento::create($request->all());

        // 3. Devolver una respuesta JSON con el evento creado y un código de estado 201 (Created)
        return response()->json($evento, 201);
    }

    // Mostrar un evento específico
    public function show($id)
    {
        $evento = Evento::find($id);
        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }
        return response()->json($evento, 200);
    }

    // Actualizar un evento existente
    public function update(Request $request, $id)
    {
        $evento = Evento::find($id);
        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_fin' => 'sometimes|required|date|after_or_equal:fecha_inicio', 
            'ubicacion' => 'nullable|string|max:255'
        ]);

        $evento->update($request->all());
        return response()->json($evento, 200);
    }

    // Eliminar un evento
    public function destroy($id)
    {
        $evento = Evento::find($id);
        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $evento->delete();
        return response()->json(['message' => 'Evento eliminado'], 200);
    }
}
