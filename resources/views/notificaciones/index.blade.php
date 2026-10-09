<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones - SMM Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideLeft { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes bellRing {
            0%, 100% { transform: rotate(0deg); }
            10%, 30%, 50%, 70%, 90% { transform: rotate(-10deg); }
            20%, 40%, 60%, 80% { transform: rotate(10deg); }
        }
        .animate-fadeInUp { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .animate-fadeIn { animation: fadeIn 0.6s ease-out forwards; opacity: 0; }
        .animate-slideLeft { animation: slideLeft 0.5s ease-out forwards; opacity: 0; }
        .animate-bellRing { animation: bellRing 1.5s ease-in-out; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        .navbar-blur { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }

        .notif-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .notif-card:hover {
            transform: translateX(4px);
            box-shadow: 0 6px 18px rgba(15, 81, 50, 0.1);
        }

        .table-row { transition: all 0.2s ease; }
        .table-row:hover { background-color: #f0fdf4; }

        .btn-modern { position: relative; overflow: hidden; transition: all 0.3s ease; }
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-modern:hover::before { left: 100%; }
        .btn-modern:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0, 166, 81, 0.3); }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-green-50 to-gray-100 min-h-screen">

    @php
        $hayNoLeidas = $solicitudes->where('estado', 'pendiente')->count() > 0;
    @endphp

    <nav class="sticky top-0 z-50 bg-[#0f5132]/95 navbar-blur shadow-lg border-b border-[#fbbf24]/30">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center border-2 border-[#fbbf24] shadow-md group-hover:scale-105 transition-transform duration-300">
                    <span class="text-[#0f5132] text-sm font-bold">SMM</span>
                </div>
                <div>
                    <p class="text-white font-semibold text-sm">SMM Digital</p>
                    <p class="text-green-200 text-xs">Cooperativa Santa María Magdalena</p>
                </div>
            </a>
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-[#fbbf24] rounded-full flex items-center justify-center shadow-md">
                        <span class="text-[#0f5132] font-bold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <span class="text-green-100 hidden sm:inline">{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-green-100 hover:text-white text-xs px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6">

        <!-- ENCABEZADO -->
        <div class="mb-6 animate-fadeInUp">
            <a href="{{ route('home') }}" class="inline-flex items-center text-[#00a651] text-base hover:text-[#0f5132] transition-colors group">
                <svg class="w-5 h-5 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al inicio
            </a>
            <div class="flex items-center justify-between mt-3 flex-wrap gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-[#0f5132] flex items-center gap-3">
                        <svg class="w-9 h-9 text-[#00a651] {{ $hayNoLeidas ? 'animate-bellRing' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        Notificaciones
                    </h1>
                    <p class="text-gray-600 text-base mt-1">Revisa el estado de tus solicitudes y descarga documentos</p>
                </div>
                @if($solicitudes->count() > 0)
                    <div class="flex items-center gap-3 bg-white rounded-full shadow-md px-5 py-3 border border-gray-100">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#00a651] to-[#0f5132] rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-base">{{ $solicitudes->count() }}</span>
                        </div>
                        <span class="text-sm text-gray-700 font-semibold">solicitudes registradas</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- LAYOUT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- NOTIFICACIONES -->
            <div class="lg:col-span-1 bg-white rounded-xl shadow-md p-5 animate-fadeInUp delay-100 border border-gray-100 flex flex-col">
                <h2 class="text-base font-semibold text-[#0f5132] uppercase mb-4 border-l-4 border-[#00a651] pl-3 flex items-center gap-2 flex-shrink-0">
                    <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Últimas notificaciones
                </h2>

                <div class="overflow-y-auto pr-2 -mr-2 space-y-3" style="max-height: 600px; scrollbar-width: thin;">

                    @if($solicitudes->isEmpty())
                        <div class="text-center py-10">
                            <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium text-base">Sin notificaciones</p>
                            <a href="{{ route('preevaluacion.index') }}" class="inline-flex items-center gap-1 mt-3 text-[#00a651] text-sm font-semibold hover:underline">
                                Realizar preevaluación →
                            </a>
                        </div>
                    @else
                        @foreach($solicitudes as $index => $solicitud)
                            @php
                                $cal = $solicitud->calificacion;
                                $bgLight = match($cal) {
                                    'Preaprobado' => 'bg-green-50 border-green-200',
                                    'Observado' => 'bg-yellow-50 border-yellow-200',
                                    'Rechazado' => 'bg-red-50 border-red-200',
                                    default => 'bg-gray-50 border-gray-200',
                                };
                                $bgIcon = match($cal) {
                                    'Preaprobado' => 'bg-green-500',
                                    'Observado' => 'bg-yellow-500',
                                    'Rechazado' => 'bg-red-500',
                                    default => 'bg-gray-500',
                                };
                            @endphp
                            <div class="notif-card p-4 {{ $bgLight }} rounded-lg border animate-slideLeft"
                                 style="animation-delay: {{ 0.15 + ($index * 0.05) }}s">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 {{ $bgIcon }} rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                                        @if($cal === 'Preaprobado')
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @elseif($cal === 'Observado')
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2 flex-wrap">
                                            <h3 class="font-bold text-[#0f5132] text-base">{{ $cal }}</h3>
                                            <span class="text-xs text-gray-500 whitespace-nowrap">
                                                {{ $solicitud->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-700 mt-2 leading-relaxed">
                                            Solicitud por S/ {{ number_format($solicitud->monto_solicitado, 2) }}
                                        </p>
                                        <span class="inline-block text-xs bg-white/70 text-[#0f5132] px-2.5 py-1 rounded-full font-semibold mt-2">
                                            Ratio: {{ $solicitud->ratio_deuda_ingreso }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- HISTORIAL -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6 animate-fadeInUp delay-200 border border-gray-100 flex flex-col">
                <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
                    <h2 class="text-base font-semibold text-[#0f5132] uppercase border-l-4 border-[#00a651] pl-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Historial de solicitudes
                    </h2>

                    <div class="flex items-center gap-2">
                        <button type="button" onclick="window.print()"
                                class="inline-flex items-center gap-1.5 text-[#0f5132] bg-[#00a651]/10 hover:bg-[#00a651]/20 text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Imprimir
                        </button>
                        <a href="{{ route('preevaluacion.index') }}"
                           class="btn-modern inline-flex items-center gap-1.5 text-white bg-gradient-to-r from-[#00a651] to-[#0f5132] text-sm font-semibold px-4 py-2 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Nueva solicitud
                        </a>
                    </div>
                </div>

                <div class="overflow-y-auto pr-1 -mr-1" style="max-height: 600px; scrollbar-width: thin;">
                    @if($solicitudes->isEmpty())
                        <p class="text-base text-gray-500 text-center py-10 italic">No tienes solicitudes registradas.</p>
                    @else
                        <table class="w-full">
                            <thead class="text-xs text-white uppercase bg-[#0f5132] sticky top-0 z-10">
                                <tr>
                                    <th class="py-3 text-left px-4 font-semibold">Fecha</th>
                                    <th class="py-3 text-left px-4 font-semibold">Monto</th>
                                    <th class="py-3 text-left px-4 font-semibold">Plazo</th>
                                    <th class="py-3 text-left px-4 font-semibold">Ratio</th>
                                    <th class="py-3 text-left px-4 font-semibold">Calificación</th>
                                    <th class="py-3 text-left px-4 font-semibold">Estado</th>
                                    <th class="py-3 text-right px-4 font-semibold">Documento</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($solicitudes as $index => $solicitud)
                                    @php
                                        $bgBadge = match($solicitud->calificacion) {
                                            'Preaprobado' => 'bg-green-100 text-green-800',
                                            'Observado' => 'bg-yellow-100 text-yellow-800',
                                            'Rechazado' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                        $bgEstado = match($solicitud->estado) {
                                            'aprobado' => 'bg-green-100 text-green-800',
                                            'observado' => 'bg-yellow-100 text-yellow-800',
                                            'rechazado' => 'bg-red-100 text-red-800',
                                            'pendiente' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <tr class="table-row animate-fadeIn" style="animation-delay: {{ 0.3 + ($index * 0.04) }}s">
                                        <td class="py-3.5 px-4 text-gray-700 font-medium text-sm whitespace-nowrap">
                                            {{ $solicitud->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-800 font-semibold text-sm whitespace-nowrap">
                                            S/ {{ number_format($solicitud->monto_solicitado, 2) }}
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-700 text-sm whitespace-nowrap">
                                            {{ $solicitud->plazo_meses }} m.
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-700 text-sm whitespace-nowrap">
                                            {{ $solicitud->ratio_deuda_ingreso }}%
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="{{ $bgBadge }} px-3 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap">
                                                {{ $solicitud->calificacion }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="{{ $bgEstado }} px-3 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap capitalize">
                                                {{ $solicitud->estado }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-right">
                                            @if($solicitud->dni_archivos && count($solicitud->dni_archivos) > 0)
                                                <a href="{{ route('documentos.show', ['path' => $solicitud->dni_archivos[0]]) }}" target="_blank"
                                                   class="inline-flex items-center gap-1.5 text-[#00a651] hover:text-[#0f5132] font-semibold text-xs bg-[#00a651]/10 hover:bg-[#00a651]/20 px-3 py-1.5 rounded-md transition-colors whitespace-nowrap">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                    </svg>
                                                    Ver
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs italic">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>

    </main>
</body>
</html>