<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preevaluación Crediticia - SMM Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-8px); } 75% { transform: translateX(8px); } }
        @keyframes popInPreview { 0% { opacity: 0; transform: scale(0.5); } 70% { transform: scale(1.1); } 100% { opacity: 1; transform: scale(1); } }
        .animate-fadeInUp { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .animate-fadeIn { animation: fadeIn 0.6s ease-out forwards; opacity: 0; }
        .animate-shake { animation: shake 0.5s ease-in-out; }
        .animate-popInPreview { animation: popInPreview 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .navbar-blur { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .input-modern { transition: all 0.3s ease; }
        .input-modern:focus { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0, 166, 81, 0.15); }
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
        .spinner {
            display: inline-block;
            width: 18px; height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .upload-zone { transition: all 0.3s ease; cursor: pointer; }
        .upload-zone:hover { border-color: #00a651; background-color: #f0fdf4; }
        .upload-zone.dragover { border-color: #00a651; background-color: #dcfce7; transform: scale(1.02); }
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
            <h1 class="text-3xl font-bold text-[#0f5132] mt-3">Preevaluación Crediticia</h1>
            <p class="text-gray-600 text-sm mt-1">Completa tu información para conocer la viabilidad de tu crédito</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-5 animate-shake flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('preevaluacion.store') }}" enctype="multipart/form-data"
              id="formPreevaluacion" class="bg-white rounded-xl shadow-md p-6 animate-fadeInUp delay-100 border border-gray-100">
            @csrf

            <!-- SECCIÓN 1 -->
            <h2 class="font-semibold text-[#0f5132] mb-5 border-l-4 border-[#00a651] pl-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                1. Datos del crédito
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Monto solicitado (S/)</label>
                    <input type="number" name="monto_solicitado" value="{{ old('monto_solicitado') }}"
                           class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Plazo (meses)</label>
                    <input type="number" name="plazo_meses" value="{{ old('plazo_meses') }}"
                           class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none" required>
                </div>
            </div>

            <!-- SECCIÓN 2 -->
            <h2 class="font-semibold text-[#0f5132] mb-5 border-l-4 border-[#00a651] pl-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                2. Información económica
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ingreso mensual (S/)</label>
                    <input type="number" name="ingreso_mensual" value="{{ old('ingreso_mensual') }}"
                           class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Egresos mensuales (S/)</label>
                    <input type="number" name="egresos_mensuales" value="{{ old('egresos_mensuales') }}"
                           class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Carga familiar</label>
                    <select name="carga_familiar" class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none">
                        <option value="0">0 dependientes</option>
                        <option value="1">1 dependiente</option>
                        <option value="2">2 dependientes</option>
                        <option value="3">3 o más dependientes</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Antigüedad laboral</label>
                    <select name="antiguedad_laboral" class="input-modern w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none">
                        <option value="Menos de 1 año">Menos de 1 año</option>
                        <option value="1 a 3 años">1 a 3 años</option>
                        <option value="Más de 3 años">Más de 3 años</option>
                    </select>
                </div>
            </div>

            <!-- SECCIÓN 3 -->
            <h2 class="font-semibold text-[#0f5132] mb-5 border-l-4 border-[#00a651] pl-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#00a651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                3. Documentos adjuntos
            </h2>
            <div class="space-y-4 mb-6">

                <!-- DNI -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        DNI (ambas caras - PDF o imagen)
                        <span class="text-xs text-gray-400 font-normal">Puedes subir varias fotos</span>
                    </label>
                    <div id="zonaDNI" class="upload-zone block w-full border-2 border-dashed border-gray-300 rounded-lg relative overflow-hidden">
                        <!-- Prompt inicial -->
                        <div class="upload-prompt cursor-pointer flex flex-col items-center justify-center py-6" onclick="document.getElementById('inputDNI').click()">
                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-sm text-gray-500"><span class="font-semibold">Haz clic</span> para subir el DNI</p>
                            <p class="text-xs text-gray-400 mt-1">Puedes seleccionar varias imágenes a la vez · PDF, JPG o PNG (máx. 5 MB c/u)</p>
                        </div>
                        <!-- Preview -->
                        <div class="upload-preview hidden flex-col items-center justify-center py-4 animate-popInPreview">
                            <div id="previewDNI" class="flex flex-wrap gap-2 justify-center mb-3 px-4"></div>
                            <p class="text-sm font-semibold max-w-md text-center px-4" id="nombreDNI"></p>
                            <p class="text-xs text-gray-400 mt-1">Haz clic en una miniatura para cambiarla o en el "+" para añadir más</p>
                        </div>
                        <input type="file" id="inputDNI" name="dni_archivos[]" accept=".pdf,.jpg,.jpeg,.png" class="hidden" multiple required>
                        <input type="file" id="inputExtraDNI" accept=".pdf,.jpg,.jpeg,.png" class="hidden" multiple>
                    </div>
                </div>

                <!-- Boleta -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Boleta de pago (PDF o imagen)
                        <span class="text-xs text-gray-400 font-normal">Puedes subir varias boletas</span>
                    </label>
                    <div id="zonaBoleta" class="upload-zone block w-full border-2 border-dashed border-gray-300 rounded-lg relative overflow-hidden">
                        <div class="upload-prompt cursor-pointer flex flex-col items-center justify-center py-6" onclick="document.getElementById('inputBoleta').click()">
                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500"><span class="font-semibold">Haz clic</span> para subir las boletas</p>
                            <p class="text-xs text-gray-400 mt-1">Puedes seleccionar varias boletas a la vez · PDF, JPG o PNG (máx. 5 MB c/u)</p>
                        </div>
                        <div class="upload-preview hidden flex-col items-center justify-center py-4 animate-popInPreview">
                            <div id="previewBoleta" class="flex flex-wrap gap-2 justify-center mb-3 px-4"></div>
                            <p class="text-sm font-semibold max-w-md text-center px-4" id="nombreBoleta"></p>
                            <p class="text-xs text-gray-400 mt-1">Haz clic en una miniatura para cambiarla o en el "+" para añadir más</p>
                        </div>
                        <input type="file" id="inputBoleta" name="boleta_archivos[]" accept=".pdf,.jpg,.jpeg,.png" class="hidden" multiple required>
                        <input type="file" id="inputExtraBoleta" accept=".pdf,.jpg,.jpeg,.png" class="hidden" multiple>
                    </div>
                </div>
            </div>

            <button type="submit" id="btnEnviar"
                    class="btn-modern w-full bg-gradient-to-r from-[#00a651] to-[#0f5132] text-white font-semibold py-3.5 rounded-lg flex items-center justify-center gap-2">
                <span id="btnText">Enviar solicitud de preevaluación</span>
                <svg id="btnIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
                <span id="btnSpinner" class="spinner hidden"></span>
            </button>
        </form>
    </main>

    <script>
        // ===== FUNCIÓN PARA CREAR MINIATURAS =====
        function crearMiniatura(file) {
            const item = document.createElement('div');
            item.className = 'relative';
            item.title = file.name;

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'w-20 h-20 object-cover rounded-lg border-2 border-[#00a651] shadow-md';
                img.alt = file.name;
                item.appendChild(img);
            } else if (file.type === 'application/pdf') {
                item.innerHTML = `
                    <div class="w-20 h-20 bg-red-50 rounded-lg flex flex-col items-center justify-center border-2 border-red-300 shadow-md">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs font-bold text-red-500">PDF</span>
                    </div>
                `;
            }
            return item;
        }

        // ===== FUNCIÓN PRINCIPAL DE PREVIEW =====
        function mostrarMultiPreview(input, zonaId, previewId, nombreId, inputExtraId) {
            const zona = document.getElementById(zonaId);
            const prompt = zona.querySelector('.upload-prompt');
            const previewBox = zona.querySelector('.upload-preview');
            const preview = document.getElementById(previewId);
            const nombre = document.getElementById(nombreId);

            if (input.files && input.files.length > 0) {
                prompt.classList.add('hidden');
                previewBox.classList.remove('hidden');
                previewBox.classList.add('flex');

                const files = Array.from(input.files);
                const plural = files.length > 1 ? 's' : '';
                nombre.innerHTML = `<span class="text-green-600">✓ ${files.length} archivo${plural} cargado${plural} correctamente</span>`;

                preview.innerHTML = '';
                files.forEach(file => {
                    preview.appendChild(crearMiniatura(file));
                });

                // Tarjeta "+" para añadir más archivos
                const btnAgregar = document.createElement('button');
                btnAgregar.type = 'button';
                btnAgregar.className = 'w-20 h-20 border-2 border-dashed border-[#00a651] rounded-lg flex flex-col items-center justify-center text-[#00a651] hover:bg-[#00a651]/10 hover:scale-105 transition-all duration-200 shadow-sm';
                btnAgregar.title = 'Añadir más archivos';
                btnAgregar.innerHTML = `
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="text-[10px] font-semibold mt-0.5">Añadir</span>
                `;
                btnAgregar.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    document.getElementById(inputExtraId).click();
                });
                preview.appendChild(btnAgregar);
            }
        }

        // ===== CONFIGURAR LOS DOS CAMPOS (DNI y Boleta) =====
        function configurarCampo(inputId, extraInputId, zonaId, previewId, nombreId) {
            const input = document.getElementById(inputId);
            const inputExtra = document.getElementById(extraInputId);

            // Cuando se seleccionan archivos por primera vez
            input.addEventListener('change', () => {
                mostrarMultiPreview(input, zonaId, previewId, nombreId, extraInputId);
            });

            // Cuando se agregan más archivos con el botón "+"
            inputExtra.addEventListener('change', () => {
                const dt = new DataTransfer();
                Array.from(input.files).forEach(f => dt.items.add(f));
                Array.from(inputExtra.files).forEach(f => dt.items.add(f));
                input.files = dt.files;
                inputExtra.value = '';
                mostrarMultiPreview(input, zonaId, previewId, nombreId, extraInputId);
            });
        }

        configurarCampo('inputDNI', 'inputExtraDNI', 'zonaDNI', 'previewDNI', 'nombreDNI');
        configurarCampo('inputBoleta', 'inputExtraBoleta', 'zonaBoleta', 'previewBoleta', 'nombreBoleta');

        // ===== SPINNER AL ENVIAR =====
        const form = document.getElementById('formPreevaluacion');
        const btnEnviar = document.getElementById('btnEnviar');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        const btnSpinner = document.getElementById('btnSpinner');

        form.addEventListener('submit', function() {
            btnText.textContent = 'Enviando solicitud...';
            btnIcon.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            btnEnviar.disabled = true;
            btnEnviar.classList.add('opacity-90', 'cursor-wait');
        });
    </script>
</body>
</html>