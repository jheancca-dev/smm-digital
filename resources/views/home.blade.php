<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMM Digital - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        @keyframes glow { 0%, 100% { box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.4); } 50% { box-shadow: 0 0 0 12px rgba(251, 191, 36, 0); } }
        .animate-fadeInUp { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; opacity: 0; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-glow { animation: glow 2s infinite; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }

        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 20px 40px rgba(15, 81, 50, 0.15); }

        .navbar-blur { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-green-50 to-gray-100 min-h-screen">

    @php
        $user = Auth::user();
        $hoy = now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY');
        $hora = now()->hour;
        $saludo = $hora < 12 ? 'Hola' : ($hora < 19 ? 'Hola' : 'Buenas noches');
    @endphp

    <!-- NAVBAR -->
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

            <!-- ÁREA DE PERFIL AGRANDADA -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3 bg-white/10 hover:bg-white/15 backdrop-blur rounded-full pl-2 pr-4 py-2 border border-white/10 transition-all duration-300">
                    <div class="w-11 h-11 bg-[#fbbf24] rounded-full flex items-center justify-center shadow-md">
                        <span class="text-[#0f5132] font-bold text-base">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-white text-sm font-semibold leading-tight">{{ $user->name }}</p>
                        <p class="text-[#fbbf24] text-xs uppercase font-bold leading-tight">{{ $user->role }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-green-100 hover:text-white hover:bg-white/10 text-sm font-medium px-4 py-2.5 rounded-full transition-all duration-200 border border-white/10 hover:border-white/30">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6">

        <!-- SECCIÓN 1: SALUDO PERSONALIZADO -->
        <div class="bg-gradient-to-r from-[#0f5132] via-[#00a651] to-[#0f5132] rounded-2xl shadow-xl p-8 mb-6 animate-fadeInUp relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#fbbf24]/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/5 rounded-full -ml-20 -mb-20"></div>

            <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">
                <div>
                    <p class="text-[#fbbf24] text-sm font-semibold mb-1">{{ ucfirst($hoy) }}</p>
                    <h1 class="text-4xl md:text-5xl font-bold text-white">
                        {{ $saludo }}, {{ $user->name }} 👋
                    </h1>
                    <p class="text-green-100 mt-3 text-lg">Bienvenido a tu plataforma de preevaluación crediticia</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-4 border border-white/20 animate-float">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg border-4 border-[#fbbf24]">
                        <span class="text-[#0f5132] text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 2: TÍTULO DE MÓDULOS -->
        <div class="text-center mb-6 animate-fadeInUp delay-200">
            <h2 class="text-2xl font-bold text-[#0f5132] relative inline-block">
                Módulos del sistema
                <span class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-[#fbbf24] to-transparent rounded-full"></span>
            </h2>
            <p class="text-gray-600 mt-3">Selecciona el módulo que necesites usar</p>
        </div>

        <!-- SECCIÓN 3: TARJETAS DE MÓDULOS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <!-- Módulo 1 -->
            <a href="{{ route('simulador.index') }}"
               class="card-hover block p-6 bg-white rounded-xl shadow-md border-l-4 border-[#00a651] animate-fadeInUp delay-300 group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#00a651]/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-[#00a651]/10 rounded-xl flex items-center justify-center group-hover:bg-[#00a651]/20 group-hover:scale-110 transition-all duration-300">
                            <svg class="w-7 h-7 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h4m-9 7h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-[#00a651] bg-[#00a651]/10 px-3 py-1 rounded-full">Módulo 1</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#0f5132] group-hover:text-[#00a651] transition-colors mb-2">
                        Simulador de Créditos
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Calcula la cuota mensual, TEA y total a pagar de tu préstamo antes de solicitarlo.
                    </p>
                    <div class="flex items-center text-[#00a651] text-sm font-semibold">
                        Ingresar al módulo
                        <svg class="w-5 h-5 ml-1 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Módulo 2 -->
            <a href="{{ route('preevaluacion.index') }}"
               class="card-hover block p-6 bg-white rounded-xl shadow-md border-l-4 border-[#00a651] animate-fadeInUp delay-400 group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#00a651]/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-[#00a651]/10 rounded-xl flex items-center justify-center group-hover:bg-[#00a651]/20 group-hover:scale-110 transition-all duration-300">
                            <svg class="w-7 h-7 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-[#00a651] bg-[#00a651]/10 px-3 py-1 rounded-full">Módulo 2</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#0f5132] group-hover:text-[#00a651] transition-colors mb-2">
                        Preevaluación Crediticia
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Envía tu solicitud con documentos y conoce la viabilidad de tu crédito al instante.
                    </p>
                    <div class="flex items-center text-[#00a651] text-sm font-semibold">
                        Ingresar al módulo
                        <svg class="w-5 h-5 ml-1 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Módulo 3: Panel Analistas (solo si es analista o admin) -->
            @if($user->role === 'analista' || $user->role === 'admin')
                <a href="{{ route('analista.index') }}"
                   class="card-hover block p-6 bg-white rounded-xl shadow-md border-l-4 border-[#fbbf24] animate-fadeInUp delay-500 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#fbbf24]/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-14 h-14 bg-[#fbbf24]/10 rounded-xl flex items-center justify-center group-hover:bg-[#fbbf24]/20 group-hover:scale-110 transition-all duration-300">
                                <svg class="w-7 h-7 text-[#fbbf24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-[#fbbf24] bg-[#fbbf24]/10 px-3 py-1 rounded-full flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Analistas
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-[#0f5132] group-hover:text-[#fbbf24] transition-colors mb-2">
                            Panel de Analistas
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Gestiona todas las solicitudes recibidas, revísalas y emite el dictamen final.
                        </p>
                        <div class="flex items-center text-[#fbbf24] text-sm font-semibold">
                            Ingresar al módulo
                            <svg class="w-5 h-5 ml-1 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endif

            <!-- Módulo 4: Notificaciones -->
            <a href="{{ route('notificaciones.index') }}"
               class="card-hover block p-6 bg-white rounded-xl shadow-md border-l-4 border-[#fbbf24] animate-fadeInUp delay-500 group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#fbbf24]/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-[#fbbf24]/10 rounded-xl flex items-center justify-center group-hover:bg-[#fbbf24]/20 group-hover:scale-110 transition-all duration-300">
                            <svg class="w-7 h-7 text-[#fbbf24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-[#fbbf24] bg-[#fbbf24]/10 px-3 py-1 rounded-full">Módulo 3</span>
                    </div>
                    <h3 class="text-xl font-bold text-[#0f5132] group-hover:text-[#fbbf24] transition-colors mb-2">
                        Notificaciones
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Revisa el historial de tus solicitudes y el estado actualizado de cada una.
                    </p>
                    <div class="flex items-center text-[#fbbf24] text-sm font-semibold">
                        Ingresar al módulo
                        <svg class="w-5 h-5 ml-1 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

        </div>

        <!-- SECCIÓN 4: BANNER INFORMATIVO -->
        <div class="bg-gradient-to-r from-[#00a651]/10 to-[#0f5132]/10 border-l-4 border-[#00a651] rounded-xl p-6 animate-fadeInUp delay-600 flex items-start gap-4">
            <div class="w-12 h-12 bg-[#00a651]/20 rounded-full flex items-center justify-center flex-shrink-0 animate-glow">
                <svg class="w-6 h-6 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-[#0f5132] text-lg">¿Cómo funciona SMM Digital?</h4>
                <p class="text-sm text-gray-700 mt-2 leading-relaxed">
                    Primero <strong>simula tu crédito</strong> para conocer la cuota mensual. Luego envía tu <strong>preevaluación</strong> con tus documentos. El sistema evaluará tu capacidad de pago y un <strong>analista</strong> revisará tu caso. Finalmente, recibirás una <strong>notificación</strong> con la decisión final.
                </p>
            </div>
        </div>

    </main>
</body>
</html>