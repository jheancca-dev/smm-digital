<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimuladorController extends Controller
{
    public function index()
    {
        return view('simulador.index');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:100',
            'plazo' => 'required|integer|min:1',
            'tea' => 'required|numeric|min:0',
        ]);

        $monto = $request->monto;
        $plazo = $request->plazo;
        $tea = $request->tea;

        // Convertir TEA a tasa mensual
        $tem = pow(1 + ($tea / 100), 1/12) - 1;

        // Fórmula de cuota fija
        $cuota = $monto * ($tem * pow(1 + $tem, $plazo)) / (pow(1 + $tem, $plazo) - 1);
        $totalPagar = $cuota * $plazo;

        return view('simulador.index', [
            'monto' => $monto,
            'plazo' => $plazo,
            'tea' => $tea,
            'cuota' => round($cuota, 2),
            'totalPagar' => round($totalPagar, 2),
            'tem' => round($tem * 100, 4),
        ]);
    }
}