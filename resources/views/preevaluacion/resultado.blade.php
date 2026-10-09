<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - SMM Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes popIn {
            0%   { opacity: 0; transform: scale(0) rotate(-180deg); }
            60%  { opacity: 1; transform: scale(1.25) rotate(10deg); }
            80%  { transform: scale(0.95) rotate(-3deg); }
            100% { opacity: 1; transform: scale(1) rotate(0deg); }
        }
        @keyframes pulseSuccess { 0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5); } 50% { box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); } }
        @keyframes pulseWarning { 0%, 100% { box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.5); } 50% { box-shadow: 0 0 0 15px rgba(251, 191, 36, 0); } }
        @keyframes pulseDanger { 0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.5); } 50% { box-shadow: 0 0 0 15px rgba(239, 68, 68, 0); } }

        .animate-fadeInUp { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .animate-slideDown { animation: slideDown 0.7s ease-out forwards; opacity: 0; }
        .animate-popIn { animation: popIn 0.9s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .animate-pulseSuccess { animation: pulseSuccess 2s infinite 1s; }
        .animate-pulseWarning { animation: pulseWarning 2s infinite 1s; }
        .animate-pulseDanger { animation: pulseDanger 2s infinite 1s; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        .navbar-blur { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }

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
        $cal = $solicitud->calificacion;
        $colorBg = match($cal) {
            'Preaprobado' => '#22c55e',
            'Observado'   => '#f59e0b',
            'Rechazado'   => '#ef4444',
            default       => '#6b7280',
        };
        $colorText = match($cal) {
            'Preaprobado' => 'text-green-600',
            'Observado'   => 'text-yellow-600',
            'Rechazado'   => 'text-red-600',
            default       => 'text-gray-600',
        };
        $colorBorder = match($cal) {
            'Preaprobado' => 'border-green-500',
            'Observado'   => 'border-yellow-500',
            'Rechazado'   => 'border-red-500',
            default       => 'border-gray-500',
        };
        $colorBgLight = match($cal) {
            'Preaprobado' => 'bg-green-50',
            'Observado'   => 'bg-yellow-50',
            'Rechazado'   => 'bg-red-50',
            default       => 'bg-gray-50',
        };
        $colorTextStrong = match($cal) {
            'Preaprobado' => 'text-green-700',
            'Observado'   => 'text-yellow-700',
            'Rechazado'   => 'text-red-700',
            default       => 'text-gray-700',
        };
        $pulseClass = match($cal) {
            'Preaprobado' => 'animate-pulseSuccess',
            'Observado'   => 'animate-pulseWarning',
            'Rechazado'   => 'animate-pulseDanger',
            default       => '',
        };
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

    <main class="max-w-3xl mx-auto p-6">

        <div class="mb-6 animate-fadeInUp">
            <a href="{{ route('home') }}" class="inline-flex items-center text-[#00a651] text-sm hover:text-[#0f5132] transition-colors group">
                <svg class="w-4 h-4 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al inicio
            </a>
            <h1 class="text-3xl font-bold text-[#0f5132] mt-3">Resultado de la Preevaluación</h1>
        </div>

        <!-- TARJETA DE RESULTADO -->
        <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 {{ $colorBorder }} mb-6 animate-slideDown delay-100">
            <!-- Ícono + Texto del resultado -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-6">
                <!-- Ícono animado -->
                <div class="flex-shrink-0 animate-popIn delay-200">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center {{ $pulseClass }}"
                         style="background-color: {{ $colorBg }}; box-shadow: 0 8px 20px {{ $colorBg }}55;">
                        @if($cal === 'Preaprobado')
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        @elseif($cal === 'Observado')
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01"/>
                            </svg>
                        @elseif($cal === 'Rechazado')
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- Texto del resultado -->
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-2xl font-bold">
                        <span class="text-gray-700">Resultado:</span>
                        <span class="{{ $colorText }}">{{ $cal }}</span>
                    </h2>
                    <div class="mt-3 inline-flex items-center gap-2 {{ $colorBgLight }} {{ $colorTextStrong }} px-3 py-1.5 rounded-full text-sm font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h4"/>
                        </svg>
                        Ratio Deuda/Ingreso: {{ $solicitud->ratio_deuda_ingreso }}%
                    </div>
                </div>
            </div>

            <!-- Mensaje informativo -->
            <p class="text-sm text-gray-700 leading-relaxed mb-4">
                @if($cal === 'Preaprobado')
                    Tu solicitud ha sido <strong class="text-green-600">preaprobada</strong> por el sistema de evaluación automática. Un <strong>analista de crédito</strong> revisará tu caso para emitir la decisión final.
                @elseif($cal === 'Observado')
                    Tu solicitud requiere <strong class="text-yellow-600">revisión adicional</strong>. Un <strong>analista de crédito</strong> evaluará tu caso y se pondrá en contacto contigo para solicitar información complementaria si es necesario.
                @else
                    Tu solicitud <strong class="text-red-600">no cumple con los requisitos mínimos</strong> según el sistema de evaluación automática. Un <strong>analista de crédito</strong> revisará tu caso para confirmar la decisión final.
                @endif
            </p>

            <!-- Aviso "¿Qué sigue?" -->
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-blue-800">¿Qué sigue?</p>
                    <p class="text-xs text-blue-700 mt-1 leading-relaxed">
                        Recibirás una <strong>notificación</strong> cuando un analista revise tu solicitud. Puedes revisar el estado en cualquier momento desde el módulo de <strong>Notificaciones</strong>.
                    </p>
                </div>
            </div>
        </div>

        <!-- RESUMEN -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 animate-fadeInUp delay-300 border border-gray-100">
            <h3 class="font-semibold text-[#0f5132] mb-5 border-l-4 border-[#00a651] pl-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Resumen de tu solicitud
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Monto solicitado</p>
                    <p class="font-bold text-[#0f5132] text-lg">S/ {{ number_format($solicitud->monto_solicitado, 2) }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Plazo</p>
                    <p class="font-bold text-[#0f5132] text-lg">{{ $solicitud->plazo_meses }} meses</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Ingreso mensual</p>
                    <p class="font-bold text-[#0f5132] text-lg">S/ {{ number_format($solicitud->ingreso_mensual, 2) }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Egresos mensuales</p>
                    <p class="font-bold text-[#0f5132] text-lg">S/ {{ number_format($solicitud->egresos_mensuales, 2) }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Cuota estimada</p>
                    <p class="font-bold text-[#0f5132] text-lg">S/ {{ number_format($cuotaEstimada, 2) }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Estado</p>
                    <p class="font-bold text-[#0f5132] text-lg capitalize">{{ $solicitud->estado }}</p>
                </div>
            </div>
        </div>

        <!-- BOTONES -->
        <div class="flex flex-col md:flex-row gap-3 animate-fadeInUp delay-400">
            <a href="{{ route('preevaluacion.index') }}"
               class="btn-modern flex-1 text-center bg-gradient-to-r from-[#00a651] to-[#0f5132] text-white font-semibold py-3.5 rounded-lg flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva solicitud
            </a>
            <a href="{{ route('home') }}"
               class="flex-1 text-center bg-white text-[#0f5132] font-semibold py-3.5 rounded-lg border-2 border-[#0f5132] hover:bg-[#0f5132] hover:text-white transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center gap-2 shadow-md hover:shadow-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Volver al inicio
            </a>
        </div>
    </main>
</body>
</html>