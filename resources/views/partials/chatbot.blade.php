<!-- ============ CHATBOT FLOTANTE ============ -->
<div id="chatbot" class="fixed bottom-6 right-6 z-[100]">

    <!-- Botón flotante -->
    <button id="chatbotToggle" type="button"
            class="w-16 h-16 bg-gradient-to-br from-[#00a651] to-[#0f5132] rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-all duration-300 group">
        <svg id="chatbotIcon" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
        </svg>
        <!-- Indicador de "en línea" -->
        <span class="absolute -top-1 -right-1 w-5 h-5 bg-green-400 border-3 border-white rounded-full animate-pulse"></span>
    </button>

    <!-- Ventana del chat -->
    <div id="chatbotWindow" class="hidden absolute bottom-20 right-0 w-[380px] max-w-[90vw] bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col" style="max-height: 550px;">

        <!-- Cabecera -->
        <div class="bg-gradient-to-r from-[#0f5132] to-[#00a651] px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 text-[#0f5132]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Asistente SMM</p>
                    <p class="text-green-100 text-xs flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        En línea
                    </p>
                </div>
            </div>
            <button type="button" id="chatbotClose" class="text-white/80 hover:text-white hover:bg-white/10 rounded-full p-1.5 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mensajes -->
        <div id="chatbotMessages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50" style="min-height: 300px;">

            <!-- Mensaje de bienvenida -->
            <div class="flex items-start gap-2">
                <div class="w-8 h-8 bg-[#00a651] rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm max-w-[80%]">
                    <p class="text-sm text-gray-700">¡Hola! 👋 Soy el asistente virtual de SMM Digital. ¿En qué puedo ayudarte?</p>
                </div>
            </div>

            <!-- Sugerencias -->
            <div class="flex flex-wrap gap-2 pl-10">
                <button type="button" onclick="enviarSugerencia('¿Cómo simulo un crédito?')" class="text-xs bg-white border border-[#00a651]/30 text-[#0f5132] px-3 py-1.5 rounded-full hover:bg-[#00a651]/10 transition-colors">
                    ¿Cómo simulo un crédito?
                </button>
                <button type="button" onclick="enviarSugerencia('¿Qué documentos necesito?')" class="text-xs bg-white border border-[#00a651]/30 text-[#0f5132] px-3 py-1.5 rounded-full hover:bg-[#00a651]/10 transition-colors">
                    ¿Qué documentos necesito?
                </button>
                <button type="button" onclick="enviarSugerencia('¿Por qué me rechazaron?')" class="text-xs bg-white border border-[#00a651]/30 text-[#0f5132] px-3 py-1.5 rounded-full hover:bg-[#00a651]/10 transition-colors">
                    ¿Por qué me rechazaron?
                </button>
            </div>
        </div>

        <!-- Input -->
        <form id="chatbotForm" class="border-t bg-white p-3 flex items-center gap-2">
            <input type="text" id="chatbotInput" placeholder="Escribe tu pregunta..."
                   class="flex-1 border border-gray-300 rounded-full px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#00a651] focus:border-transparent outline-none"
                   autocomplete="off" maxlength="500">
            <button type="submit" id="chatbotSend"
                    class="w-10 h-10 bg-gradient-to-br from-[#00a651] to-[#0f5132] rounded-full flex items-center justify-center hover:scale-105 transition-transform flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    (function() {
        const toggle = document.getElementById('chatbotToggle');
        const window_ = document.getElementById('chatbotWindow');
        const closeBtn = document.getElementById('chatbotClose');
        const form = document.getElementById('chatbotForm');
        const input = document.getElementById('chatbotInput');
        const messages = document.getElementById('chatbotMessages');
        const sendBtn = document.getElementById('chatbotSend');

        let enviando = false; // Bloquea envíos simultáneos

        // Toggle ventana
        toggle.addEventListener('click', () => {
            window_.classList.toggle('hidden');
            if (!window_.classList.contains('hidden')) {
                input.focus();
            }
        });

        closeBtn.addEventListener('click', () => {
            window_.classList.add('hidden');
        });

        // Enviar desde sugerencias (función global)
        window.enviarSugerencia = function(texto) {
            if (enviando) return;
            input.value = texto;
            enviarMensaje(texto);
        };

        // Submit del formulario
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const texto = input.value.trim();
            if (!texto || enviando) return;
            input.value = '';
            enviarMensaje(texto);
        });

        // Función principal
        async function enviarMensaje(texto) {
            if (enviando) return;
            enviando = true;
            input.disabled = true;
            sendBtn.disabled = true;
            sendBtn.classList.add('opacity-50');

            agregarMensaje(texto, 'usuario');
            const typingId = agregarTyping();

            try {
                const response = await fetch('{{ route("chatbot.chat") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ mensaje: texto }),
                });

                const data = await response.json();
                eliminarTyping(typingId);
                agregarMensaje(data.respuesta || 'Sin respuesta.', 'bot');
            } catch (err) {
                console.error('Error chatbot:', err);
                eliminarTyping(typingId);
                agregarMensaje('😅 Hubo un error de conexión. Verifica tu internet.', 'bot');
            } finally {
                enviando = false;
                input.disabled = false;
                sendBtn.disabled = false;
                sendBtn.classList.remove('opacity-50');
                input.focus();
            }
        }

        function agregarMensaje(texto, tipo) {
            const wrapper = document.createElement('div');
            wrapper.className = 'flex items-start gap-2 ' + (tipo === 'usuario' ? 'justify-end' : '');

            const burbuja = document.createElement('div');
            burbuja.className = tipo === 'usuario'
                ? 'bg-gradient-to-br from-[#0f5132] to-[#00a651] text-white rounded-2xl rounded-tr-sm px-4 py-3 shadow-sm max-w-[80%]'
                : 'bg-white text-gray-700 rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm max-w-[80%]';
            burbuja.innerHTML = '<p class="text-sm whitespace-pre-wrap">' + escapeHtml(texto) + '</p>';

            if (tipo === 'usuario') {
                wrapper.appendChild(burbuja);
                const avatar = document.createElement('div');
                avatar.className = 'w-8 h-8 bg-[#fbbf24] rounded-full flex items-center justify-center flex-shrink-0';
                avatar.innerHTML = '<span class="text-[#0f5132] font-bold text-xs">{{ strtoupper(substr(Auth::user()->name ?? "U", 0, 1)) }}</span>';
                wrapper.appendChild(avatar);
            } else {
                const avatar = document.createElement('div');
                avatar.className = 'w-8 h-8 bg-[#00a651] rounded-full flex items-center justify-center flex-shrink-0';
                avatar.innerHTML = '<svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>';
                wrapper.appendChild(avatar);
                wrapper.appendChild(burbuja);
            }

            messages.appendChild(wrapper);
            messages.scrollTop = messages.scrollHeight;
        }

        function agregarTyping() {
            const id = 'typing-' + Date.now();
            const wrapper = document.createElement('div');
            wrapper.id = id;
            wrapper.className = 'flex items-start gap-2';
            wrapper.innerHTML = `
                <div class="w-8 h-8 bg-[#00a651] rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm">
                    <div class="flex gap-1">
                        <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></span>
                        <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.15s"></span>
                        <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></span>
                    </div>
                </div>
            `;
            messages.appendChild(wrapper);
            messages.scrollTop = messages.scrollHeight;
            return id;
        }

        function eliminarTyping(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    })();
</script>