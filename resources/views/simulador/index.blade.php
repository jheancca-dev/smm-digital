<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Créditos - SMM Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(0, 166, 81, 0.4); }
            50% { box-shadow: 0 0 0 12px rgba(0, 166, 81, 0); }
        }
        .animate-fadeInUp { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .animate-fadeIn { animation: fadeIn 0.6s ease-out forwards; opacity: 0; }
        .animate-slideDown { animation: slideDown 0.6s ease-out forwards; opacity: 0; }
        .animate-pulseGlow { animation: pulseGlow 2s infinite; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        .navbar-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .input-modern {
            transition: all 0.3s ease;
        }
        .input-modern:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 166, 81, 0.15);
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

        /* Spinner */
        .spinner {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-green-50 to-gray-100 min-h-screen">

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
            <div class="flex items-center gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-[#fbbf24] rounded-full flex items-center justify-center shadow-md">
                        <span class="text-[#0f5132] font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <span class="text-green-100 hidden sm:inline">{{ Auth::user()->name }}</span>
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

    <main class="max-w-3xl mx-auto p-6">

        <!-- ENCABEZADO -->
        <div class="mb-6 animate-fadeInUp">
            <a href="{{ route('home') }}" class="inline-flex items-center text-[#00a651] text-sm hover:text-[#0f5132] transition-colors group">
                <svg class="w-4 h-4 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al inicio
            </a>
            <h1 class="text-3xl font-bold text-[#0f5132] mt-3">Simulador de Créditos</h1>
            <p class="text-gray-600 text-sm mt-1">Calcula la cuota mensual de tu préstamo antes de solicitarlo</p>
        </div>

        <!-- FORMULARIO -->
        <form method="POST" action="{{ route('simulador.calcular') }}" id="formSimulador"
              class="bg-white rounded-xl shadow-md p-6 mb-6 animate-fadeInUp delay-100 border border-gray-100">
            @csrf

            <h2 class="font-semibold text-[#0f5132] mb-5 border-l-4 border-[#00a651] pl-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m-6 4h4m-9 7h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Datos del préstamo
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Monto solicitado (S/)</label>
                    <input type="number" name="monto" value="{{ old('monto', $monto ?? 15000) }}"
                           class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plazo (meses)</label>
                    <select name="plazo" class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none">
                        <option value="12" {{ (old('plazo', $plazo ?? 24) == 12) ? 'selected' : '' }}>12 meses</option>
                        <option value="24" {{ (old('plazo', $plazo ?? 24) == 24) ? 'selected' : '' }}>24 meses</option>
                        <option value="36" {{ (old('plazo', $plazo ?? 24) == 36) ? 'selected' : '' }}>36 meses</option>
                        <option value="48" {{ (old('plazo', $plazo ?? 24) == 48) ? 'selected' : '' }}>48 meses</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tasa Efectiva Anual - TEA (%)</label>
                    <input type="number" step="0.01" name="tea" value="{{ old('tea', $tea ?? 18.5) }}"
                           class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none" required>
                </div>
            </div>

            <button type="submit" id="btnCalcular"
                    class="btn-modern w-full mt-6 bg-gradient-to-r from-[#00a651] to-[#0f5132] text-white font-semibold py-3.5 rounded-lg flex items-center justify-center gap-2">
                <span id="btnText">Calcular cuota</span>
                <svg id="btnIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
                <span id="btnSpinner" class="spinner hidden"></span>
            </button>
        </form>

        <!-- RESULTADO -->
        @if(isset($cuota))
        <div class="bg-gradient-to-br from-[#00a651] via-[#0f5132] to-[#0a3d24] rounded-xl shadow-2xl p-8 text-white animate-slideDown relative overflow-hidden">
            <!-- Decoración de fondo -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-[#fbbf24]/10 rounded-full -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full -ml-16 -mb-16"></div>

            <div class="relative z-10">
                <p class="text-sm opacity-90 mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Cuota mensual estimada
                </p>
                <p class="text-5xl font-bold mb-1">
                    S/ <span id="cuotaAnimada" data-value="{{ $cuota }}">0.00</span>
                </p>
                <p class="text-xs opacity-75 mb-6">Cálculo realizado correctamente</p>

                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-white/20">
                    <div>
                        <p class="text-xs opacity-80 mb-1">TEA</p>
                        <p class="text-xl font-semibold">{{ $tea }}%</p>
                    </div>
                    <div>
                        <p class="text-xs opacity-80 mb-1">TEM</p>
                        <p class="text-xl font-semibold">{{ $tem }}%</p>
                    </div>
                    <div>
                        <p class="text-xs opacity-80 mb-1">Total a pagar</p>
                        <p class="text-xl font-semibold">S/ {{ number_format($totalPagar, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </main>

    <script>
        // Spinner al enviar el formulario
        const form = document.getElementById('formSimulador');
        const btnCalcular = document.getElementById('btnCalcular');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        const btnSpinner = document.getElementById('btnSpinner');

        form.addEventListener('submit', function() {
            btnText.textContent = 'Calculando...';
            btnIcon.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            btnCalcular.disabled = true;
            btnCalcular.classList.add('opacity-90', 'cursor-wait');
        });

        // Animación del número de cuota (contando desde 0)
        const cuotaAnimada = document.getElementById('cuotaAnimada');
        if (cuotaAnimada) {
            const valorFinal = parseFloat(cuotaAnimada.dataset.value);
            const duracion = 1200;
            const pasos = 60;
            let paso = 0;

            const intervalo = setInterval(() => {
                paso++;
                const progreso = paso / pasos;
                const easeOut = 1 - Math.pow(1 - progreso, 3);
                const valorActual = valorFinal * easeOut;
                cuotaAnimada.textContent = valorActual.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                if (paso >= pasos) {
                    clearInterval(intervalo);
                    cuotaAnimada.textContent = valorFinal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }
            }, duracion / pasos);
        }
    </script>
</body>
</html>