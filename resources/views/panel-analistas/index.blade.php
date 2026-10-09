<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Analistas - SMM Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-15px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes countUp { from { opacity: 0; transform: scale(0.5); } to { opacity: 1; transform: scale(1); } }
        @keyframes rowIn { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }

        .animate-fadeInUp { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .animate-fadeIn { animation: fadeIn 0.6s ease-out forwards; opacity: 0; }
        .animate-slideDown { animation: slideDown 0.5s ease-out forwards; opacity: 0; }
        .animate-countUp { animation: countUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .animate-rowIn { animation: rowIn 0.4s ease-out forwards; opacity: 0; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        .navbar-blur { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: default;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(15, 81, 50, 0.12);
        }

        .table-row {
            transition: all 0.2s ease;
        }
        .table-row:hover {
            background-color: #f0fdf4;
            transform: scale(1.005);
        }

        .btn-modern {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-modern:hover::before { left: 100%; }
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 166, 81, 0.3);
        }

        .select-estado {
            transition: all 0.2s ease;
        }
        .select-estado:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .filter-input {
            transition: all 0.3s ease;
        }
        .filter-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 166, 81, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-green-50 to-gray-100 min-h-screen">

    <nav class="sticky top-0 z-50 bg-[#0f5132]/95 navbar-blur shadow-lg border-b border-[#fbbf24]/30">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center border-2 border-[#fbbf24] shadow-md group-hover:scale-105 transition-transform duration-300">
                    <span class="text-[#0f5132] text-sm font-bold">SMM</span>
                </div>
                <div>
                    <p class="text-white font-semibold text-sm">SMM Digital - Panel Analistas</p>
                    <p class="text-green-200 text-xs">Cooperativa Santa María Magdalena</p>
                </div>
            </a>
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-[#fbbf24] rounded-full flex items-center justify-center shadow-md">
                        <span class="text-[#0f5132] font-bold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-green-100 text-xs leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-[#fbbf24] text-[10px] uppercase font-bold leading-tight">{{ Auth::user()->role }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-green-100 hover:text-white text-xs px-3 py-2 rounded-md hover:bg-white/10 transition-colors duration-200">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6">

        <!-- ENCABEZADO -->
        <div class="mb-6 animate-fadeInUp">
            <a href="{{ route('home') }}" class="inline-flex items-center text-[#00a651] text-sm hover:text-[#0f5132] transition-colors group">
                <svg class="w-4 h-4 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al inicio
            </a>
            <h1 class="text-3xl font-bold text-[#0f5132] mt-3 flex items-center gap-3">
                <svg class="w-8 h-8 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Bandeja de Solicitudes
            </h1>
            <p class="text-gray-600 text-sm mt-1">Gestión y seguimiento de preevaluaciones</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-4 animate-slideDown flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- ESTADÍSTICAS -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="stat-card bg-white rounded-xl shadow-md p-5 border-l-4 border-blue-500 animate-fadeInUp delay-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-blue-500/5 rounded-full -mr-8 -mt-8"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Pendientes de revisión</p>
                        <p class="text-3xl font-bold text-[#0f5132] mt-1 animate-countUp delay-200">{{ $stats['pendientes'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card bg-white rounded-xl shadow-md p-5 border-l-4 border-[#fbbf24] animate-fadeInUp delay-200 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-[#fbbf24]/5 rounded-full -mr-8 -mt-8"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Observados</p>
                        <p class="text-3xl font-bold text-[#0f5132] mt-1 animate-countUp delay-300">{{ $stats['observados'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-[#fbbf24]/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#fbbf24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card bg-white rounded-xl shadow-md p-5 border-l-4 border-[#00a651] animate-fadeInUp delay-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-[#00a651]/5 rounded-full -mr-8 -mt-8"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Aprobados</p>
                        <p class="text-3xl font-bold text-[#0f5132] mt-1 animate-countUp delay-400">{{ $stats['aprobados'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-card bg-white rounded-xl shadow-md p-5 border-l-4 border-red-500 animate-fadeInUp delay-400 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-red-500/5 rounded-full -mr-8 -mt-8"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Rechazados</p>
                        <p class="text-3xl font-bold text-[#0f5132] mt-1 animate-countUp delay-500">{{ $stats['rechazados'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden animate-fadeInUp delay-500">

            <!-- Filtros -->
            <form method="GET" action="{{ route('analista.index') }}" class="px-6 py-4 border-b bg-gradient-to-r from-[#f0fdf4] to-white flex items-center gap-3 flex-wrap">
                <div class="relative flex-1 min-w-[200px]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre o email..."
                           class="filter-input w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2.5 text-sm focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none">
                </div>
                <select name="estado" class="filter-input border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none">
                    <option value="">Todos los estados</option>
                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                    <option value="observado" {{ request('estado') == 'observado' ? 'selected' : '' }}>Observado</option>
                </select>
                <button type="submit" class="btn-modern bg-gradient-to-r from-[#00a651] to-[#0f5132] text-white text-sm px-5 py-2.5 rounded-lg font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filtrar
                </button>
            </form>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#0f5132] text-xs text-white uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-left">Socio</th>
                            <th class="px-6 py-4 text-left">Monto</th>
                            <th class="px-6 py-4 text-left">Ratio</th>
                            <th class="px-6 py-4 text-left">Calificación</th>
                            <th class="px-6 py-4 text-left">Estado</th>
                            <th class="px-6 py-4 text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($solicitudes as $index => $solicitud)
                            @php
                                $cal = $solicitud->calificacion;
                                $bgBadge = match($cal) {
                                    'Preaprobado' => 'bg-green-100 text-green-800 border-green-200',
                                    'Observado' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'Rechazado' => 'bg-red-100 text-red-800 border-red-200',
                                    default => 'bg-gray-100 text-gray-800 border-gray-200',
                                };
                            @endphp
                            <tr class="table-row animate-rowIn" style="animation-delay: {{ 0.5 + ($index * 0.05) }}s">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-[#0f5132]/10 rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-[#0f5132] font-bold text-sm">{{ strtoupper(substr($solicitud->user->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $solicitud->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $solicitud->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-800">S/ {{ number_format($solicitud->monto_solicitado, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-700 font-medium">{{ $solicitud->ratio_deuda_ingreso }}%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="{{ $bgBadge }} border px-3 py-1 rounded-full text-xs font-semibold inline-block">
                                        {{ $cal }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('analista.update', $solicitud->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="estado" onchange="this.form.submit()" class="select-estado border border-gray-300 rounded-lg px-2 py-1.5 text-xs font-medium cursor-pointer">
                                            <option value="pendiente" {{ $solicitud->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="aprobado" {{ $solicitud->estado == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                            <option value="rechazado" {{ $solicitud->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                            <option value="observado" {{ $solicitud->estado == 'observado' ? 'selected' : '' }}>Observado</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @php
                                        $totalDocs = 0;
                                        if ($solicitud->dni_archivos) $totalDocs += count($solicitud->dni_archivos);
                                        if ($solicitud->boleta_archivos) $totalDocs += count($solicitud->boleta_archivos);
                                    @endphp
                                    @if($totalDocs > 0)
                                        <button type="button"
                                                onclick="abrirModal({{ $solicitud->id }}, {{ json_encode($solicitud->dni_archivos ?? []) }}, {{ json_encode($solicitud->boleta_archivos ?? []) }}, '{{ $solicitud->user->name }}')"
                                                class="inline-flex items-center gap-1 text-[#00a651] hover:text-white font-semibold text-xs bg-[#00a651]/10 hover:bg-[#00a651] px-3 py-1.5 rounded-lg transition-all duration-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Ver documentos ({{ $totalDocs }})
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-xs">Sin documentos</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-gray-500 font-medium">No hay solicitudes registradas.</p>
                                    <p class="text-gray-400 text-xs mt-1">Las nuevas solicitudes aparecerán aquí.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($solicitudes->count() > 0)
                <div class="px-6 py-3 bg-gray-50 border-t text-xs text-gray-500 text-center">
                    Mostrando <strong>{{ $solicitudes->count() }}</strong> {{ $solicitudes->count() == 1 ? 'solicitud' : 'solicitudes' }}
                </div>
            @endif
        </div>
    </main>
    <!-- ============ MODAL DE DOCUMENTOS ============ -->
    <div id="modalDocumentos" class="fixed inset-0 z-[100] hidden">
        <!-- Fondo oscuro -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="cerrarModal()"></div>

        <!-- Contenido del modal -->
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden animate-slideDown">

                <!-- Cabecera -->
                <div class="bg-gradient-to-r from-[#0f5132] to-[#00a651] px-6 py-4 flex items-center justify-between text-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-lg">Documentos de la solicitud</h3>
                            <p class="text-xs text-green-100" id="modalNombreSocio">Socio</p>
                        </div>
                    </div>
                    <button type="button" onclick="cerrarModal()" class="text-white/80 hover:text-white hover:bg-white/10 rounded-full p-1.5 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Cuerpo scrolleable -->
                <div class="overflow-y-auto p-6 space-y-6">

                    <!-- Sección DNI -->
                    <div id="seccionDNI">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 bg-[#00a651]/10 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.418.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-[#0f5132]">DNI (ambas caras)</h4>
                            <span id="contadorDNI" class="text-xs bg-[#00a651]/10 text-[#0f5132] px-2 py-0.5 rounded-full font-semibold">0</span>
                        </div>
                        <div id="gridDNI" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
                        <p id="vacioDNI" class="text-sm text-gray-400 italic py-4 hidden">No se subieron documentos de DNI.</p>
                    </div>

                    <!-- Sección Boletas -->
                    <div id="seccionBoleta">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 bg-[#fbbf24]/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#fbbf24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-[#0f5132]">Boletas de pago</h4>
                            <span id="contadorBoleta" class="text-xs bg-[#fbbf24]/20 text-[#0f5132] px-2 py-0.5 rounded-full font-semibold">0</span>
                        </div>
                        <div id="gridBoleta" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
                        <p id="vacioBoleta" class="text-sm text-gray-400 italic py-4 hidden">No se subieron boletas de pago.</p>
                    </div>
                </div>

                <!-- Pie -->
                <div class="border-t px-6 py-3 bg-gray-50 flex justify-end">
                    <button type="button" onclick="cerrarModal()"
                            class="bg-[#0f5132] text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-[#00a651] transition-colors">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ SCRIPT DEL MODAL ============ -->
    <script>
        const DOCS_URL = "{{ url('documentos') }}";

        function esImagen(ruta) {
            const ext = ruta.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext);
        }

        function nombreArchivo(ruta) {
            return ruta.split('/').pop();
        }

        function crearTarjeta(ruta) {
            const url = DOCS_URL + '/' + ruta;
            const div = document.createElement('div');

            if (esImagen(ruta)) {
                div.className = 'group relative rounded-lg overflow-hidden border-2 border-gray-200 hover:border-[#00a651] shadow-sm hover:shadow-lg transition-all duration-200 cursor-pointer bg-gray-50';
                div.innerHTML = `
                    <img src="${url}" alt="${nombreArchivo(ruta)}" class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-2">
                        <p class="text-white text-[10px] font-semibold truncate w-full">${nombreArchivo(ruta)}</p>
                    </div>
                `;
                div.onclick = () => window.open(url, '_blank');
            } else {
                div.className = 'group relative rounded-lg overflow-hidden border-2 border-gray-200 hover:border-red-400 shadow-sm hover:shadow-lg transition-all duration-200 cursor-pointer bg-red-50 flex flex-col items-center justify-center py-6';
                div.innerHTML = `
                    <svg class="w-12 h-12 text-red-500 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-[11px] font-bold text-red-600 mt-2">PDF</p>
                    <p class="text-[10px] text-gray-600 px-2 truncate max-w-full mt-1">${nombreArchivo(ruta)}</p>
                `;
                div.onclick = () => window.open(url, '_blank');
            }

            return div;
        }

        function renderSeccion(rutas, gridId, contadorId, vacioId) {
            const grid = document.getElementById(gridId);
            const contador = document.getElementById(contadorId);
            const vacio = document.getElementById(vacioId);
            grid.innerHTML = '';
            contador.textContent = rutas.length;

            if (rutas.length === 0) {
                vacio.classList.remove('hidden');
                return;
            }
            vacio.classList.add('hidden');
            rutas.forEach(ruta => {
                grid.appendChild(crearTarjeta(ruta));
            });
        }

        function abrirModal(solicitudId, dniArchivos, boletaArchivos, nombreSocio) {
            document.getElementById('modalNombreSocio').textContent = 'Socio: ' + nombreSocio;
            renderSeccion(dniArchivos || [], 'gridDNI', 'contadorDNI', 'vacioDNI');
            renderSeccion(boletaArchivos || [], 'gridBoleta', 'contadorBoleta', 'vacioBoleta');
            document.getElementById('modalDocumentos').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function cerrarModal() {
            document.getElementById('modalDocumentos').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Cerrar con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') cerrarModal();
        });
    </script>
</body>
</html>