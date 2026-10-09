<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notificaciones.index', compact('solicitudes'));
    }
}