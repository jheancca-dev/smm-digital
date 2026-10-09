<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class AnalistaController extends Controller
{
    public function index(Request $request)
    {
        $query = Solicitud::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->whereHas('user', function ($q) use ($buscar) {
                $q->where('name', 'like', "%{$buscar}%")
                  ->orWhere('email', 'like', "%{$buscar}%");
            });
        }

        $solicitudes = $query->get();

        $stats = [
            'pendientes' => Solicitud::where('estado', 'pendiente')->count(),
            'observados' => Solicitud::where('estado', 'observado')->count(),
            'aprobados' => Solicitud::where('estado', 'aprobado')->count(),
            'rechazados' => Solicitud::where('estado', 'rechazado')->count(),
        ];

        return view('panel-analistas.index', compact('solicitudes', 'stats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,aprobado,rechazado,observado',
        ]);

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = $request->estado;
        $solicitud->save();

        return redirect()->route('analista.index')->with('success', 'Estado actualizado correctamente.');
    }
}