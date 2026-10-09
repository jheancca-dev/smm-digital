<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PreevaluacionController extends Controller
{
    public function index()
    {
        return view('preevaluacion.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'monto_solicitado' => 'required|numeric|min:100',
            'plazo_meses' => 'required|integer|min:1',
            'ingreso_mensual' => 'required|numeric|min:1',
            'egresos_mensuales' => 'required|numeric|min:0',
            'carga_familiar' => 'required|integer|min:0',
            'antiguedad_laboral' => 'required|string',
            'dni_archivos' => 'required|array|min:1',
            'dni_archivos.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
            'boleta_archivos' => 'required|array|min:1',
            'boleta_archivos.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Guardar múltiples archivos de DNI
        $dniPaths = [];
        foreach ($request->file('dni_archivos') as $archivo) {
            $dniPaths[] = $archivo->store('documentos/dni', 'public');
        }

        // Guardar múltiples archivos de boleta
        $boletaPaths = [];
        foreach ($request->file('boleta_archivos') as $archivo) {
            $boletaPaths[] = $archivo->store('documentos/boletas', 'public');
        }

        // Calcular ratio Deuda/Ingreso
        $cuotaEstimada = $this->calcularCuota($request->monto_solicitado, $request->plazo_meses, 18.5);
        $ratio = (($request->egresos_mensuales + $cuotaEstimada) / $request->ingreso_mensual) * 100;

        if ($ratio <= 30) {
            $calificacion = 'Preaprobado';
        } elseif ($ratio <= 40) {
            $calificacion = 'Observado';
        } else {
            $calificacion = 'Rechazado';
        }

        $solicitud = Solicitud::create([
            'user_id' => Auth::id(),
            'monto_solicitado' => $request->monto_solicitado,
            'plazo_meses' => $request->plazo_meses,
            'ingreso_mensual' => $request->ingreso_mensual,
            'egresos_mensuales' => $request->egresos_mensuales,
            'carga_familiar' => $request->carga_familiar,
            'antiguedad_laboral' => $request->antiguedad_laboral,
            'dni_archivos' => $dniPaths,
            'boleta_archivos' => $boletaPaths,
            'ratio_deuda_ingreso' => round($ratio, 2),
            'calificacion' => $calificacion,
            'estado' => match($calificacion) {
                'Preaprobado' => 'pendiente',   // requiere revisión final del analista
                'Observado'   => 'observado',   // requiere subsanación
                'Rechazado'   => 'rechazado',   // ya no hay nada que hacer
                default       => 'pendiente',
            },
        ]);

        return view('preevaluacion.resultado', compact('solicitud', 'cuotaEstimada'));
    }

    private function calcularCuota($monto, $plazo, $tea)
    {
        $tem = pow(1 + ($tea / 100), 1/12) - 1;
        return $monto * ($tem * pow(1 + $tem, $plazo)) / (pow(1 + $tem, $plazo) - 1);
    }
}