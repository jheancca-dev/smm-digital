<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string|max:500',
        ]);

        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'respuesta' => 'El asistente no está configurado (falta GEMINI_API_KEY en el .env).',
            ], 500);
        }

        // SYSTEM INSTRUCTION - Define el rol y comportamiento del asistente
        $systemInstruction = "Eres el asistente virtual oficial de 'SMM Digital', la plataforma web de preevaluación crediticia de la Cooperativa de Ahorro y Crédito Santa María Magdalena ubicada en Ayacucho, Perú.

TU ÚNICO PROPÓSITO es ayudar a los usuarios (socios de la cooperativa) a entender y usar la plataforma SMM Digital.

INFORMACIÓN DE LA PLATAFORMA:
- Simulador de Créditos: permite calcular cuota mensual, TEA y total a pagar. Se ingresa monto (mínimo S/ 100), plazo (12, 24, 36 o 48 meses) y TEA (por defecto 18.5%).
- Preevaluación Crediticia: formulario donde el socio ingresa ingreso mensual, egresos, carga familiar, antigüedad laboral y sube documentos (DNI y boletas de pago). El sistema calcula el ratio Deuda/Ingreso.
- Panel de Analistas: solo para usuarios con rol analista. Aquí se revisan las solicitudes y se cambian estados.
- Notificaciones: el socio revisa el historial de sus solicitudes y estados.

CALIFICACIONES AUTOMÁTICAS:
- Ratio Deuda/Ingreso <= 30%: Preaprobado (buena señal, verde)
- Ratio entre 30% y 40%: Observado (requiere revisión, amarillo)
- Ratio > 40%: Rechazado (no cumple requisitos, rojo)

DOCUMENTOS REQUERIDOS EN LA PREEVALUACIÓN:
- DNI (ambas caras) en formato JPG, PNG o PDF
- Boletas de pago (últimas 3) en formato JPG, PNG o PDF
- Cada archivo máximo 5 MB

REGLAS ESTRICTAS:
1. Responde SIEMPRE en español, de forma clara, amable y breve (máximo 4-5 oraciones).
2. Solo responde preguntas sobre SMM Digital y temas de créditos de la cooperativa.
3. Si te preguntan sobre temas NO relacionados con SMM Digital (política, deportes, tecnología general, etc.), responde: 'Lo siento, solo puedo ayudarte con temas relacionados a SMM Digital y los créditos de la cooperativa.'
4. NUNCA inventes información que no esté en este contexto.
5. NO uses asteriscos ni markdown. Solo texto plano y emojis ocasionales.
6. Si el usuario pregunta cómo simular un crédito: explícale que debe ir al módulo 'Simulador de Créditos' desde el Home, ingresar monto, plazo y TEA, y hacer clic en 'Calcular cuota'.
7. Si pregunta por documentos: menciónale DNI y boletas de pago.
8. Si pregunta por qué fue rechazado: explícale que es por el ratio Deuda/Ingreso mayor al 40%, y que puede intentar con un monto menor o acercarse a la agencia.";

        // Modelos a intentar (con nombres vigentes)
        $modelos = [
            'gemini-2.5-flash',
            'gemini-flash-latest',
            'gemini-2.0-flash',
        ];

        $ultimoError = 'No se pudo conectar con el asistente.';

        foreach ($modelos as $modelo) {
            try {
                // Endpoint v1beta (compatible con system_instruction)
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$modelo}:generateContent?key={$apiKey}";

                $response = Http::timeout(30)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($url, [
                        'system_instruction' => [
                            'parts' => [
                                ['text' => $systemInstruction],
                            ],
                        ],
                        'contents' => [
                            [
                                'role' => 'user',
                                'parts' => [
                                    ['text' => $request->mensaje],
                                ],
                            ],
                        ],
                        'generationConfig' => [
                            'temperature' => 0.4,
                            'maxOutputTokens' => 400,
                            'topP' => 0.9,
                        ],
                        'safetySettings' => [
                            [
                                'category' => 'HARM_CATEGORY_HARASSMENT',
                                'threshold' => 'BLOCK_NONE',
                            ],
                            [
                                'category' => 'HARM_CATEGORY_HATE_SPEECH',
                                'threshold' => 'BLOCK_NONE',
                            ],
                            [
                                'category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                                'threshold' => 'BLOCK_NONE',
                            ],
                            [
                                'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                                'threshold' => 'BLOCK_NONE',
                            ],
                        ],
                    ]);

                Log::info("Chatbot intento", [
                    'modelo' => $modelo,
                    'status' => $response->status(),
                ]);
                
                // Si es 429 (límite alcanzado), esperar y reintentar una vez
                if ($response->status() === 429) {
                    sleep(2);
                    $response = Http::timeout(30)
                        ->withHeaders(['Content-Type' => 'application/json'])
                        ->post($url, [
                            'system_instruction' => ['parts' => [['text' => $systemInstruction]]],
                            'contents' => [['role' => 'user', 'parts' => [['text' => $request->mensaje]]]],
                            'generationConfig' => ['temperature' => 0.4, 'maxOutputTokens' => 400],
                        ]);

                    if ($response->status() === 429) {
                        return response()->json([
                            'respuesta' => '⏳ He recibido muchas preguntas seguidas. Espera 20 segundos y vuelve a intentar. 😊',
                        ]);
                    }
                }

                if ($response->successful()) {
                    $data = $response->json();
                    $texto = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                    if ($texto) {
                        return response()->json([
                            'respuesta' => trim($texto),
                        ]);
                    }
                }

                $ultimoError = "Error " . $response->status() . " con {$modelo}";

            } catch (\Exception $e) {
                Log::error("Chatbot excepción", [
                    'modelo' => $modelo,
                    'error' => $e->getMessage(),
                ]);
                $ultimoError = $e->getMessage();
            }
        }

        // Mensaje más amigable según el tipo de error
            if (str_contains($ultimoError, '429')) {
                $mensaje = '⏳ He recibido muchas preguntas seguidas. Espera 20 segundos y vuelve a intentar.';
            } elseif (str_contains($ultimoError, '404')) {
                $mensaje = '⚠️ Hubo un problema técnico. Intenta de nuevo en un momento.';
            } else {
                $mensaje = '😅 No pude responder. Verifica tu internet e intenta de nuevo.';
            }

            return response()->json([
                'respuesta' => $mensaje,
            ]);
    }
}