<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class HelpChatController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string'],
            'history' => ['nullable', 'array'],
            'history.*.role' => ['required_with:history', 'string'],
            'history.*.content' => ['required_with:history', 'string'],
        ]);

        $systemPrompt = "You are an AI support assistant for the Diet Plan application. Provide concise, actionable help for troubleshooting, user guidance, and step-by-step instructions. Reference in-app navigation and Laravel artisan commands when helpful.";

        $apiKey = config('services.gemini.api_key');
        // Fallback to 2.5-flash if no model is set in config
        $model = config('services.gemini.model', 'gemini-2.5-flash');

        if (! $apiKey) {
            return response()->json([
                'reply' => 'The AI service is not configured. Please contact support to enable it.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        // Build conversation history for Gemini
        $contents = [];
        $history = Arr::get($validated, 'history', []);

        foreach ($history as $item) {
            $role = Str::of($item['role'])->lower()->value() === 'user' ? 'user' : 'model';

            $contents[] = [
                'role' => $role,
                'parts' => [
                    ['text' => $item['content']],
                ],
            ];
        }

        // Append the current user message
        $contents[] = [
            'role' => 'user',
            'parts' => [
                ['text' => $validated['message']],
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'systemInstruction' => [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $systemPrompt],
                        ],
                    ],
                    'contents' => $contents,
                    'generationConfig' => [
                        'temperature' => 0.2,
                        'topP' => 0.8,
                        'topK' => 40,
                        'maxOutputTokens' => 1024,
                    ],
                ]);

            \Log::info('Gemini API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Throwable $exception) {
            \Log::error('Gemini API Error', [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);

            return response()->json([
                'reply' => 'I could not reach the AI service right now. Please try again shortly or contact support.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        if ($response->failed()) {
            $errorPayload = null;

            try {
                $errorPayload = $response->json();
            } catch (\Throwable $parseException) {
                // Ignore parse errors and fall back to a generic message
            }

            if ($errorPayload) {
                \Log::warning('Gemini API error', [
                    'status' => $response->status(),
                    'error' => $errorPayload,
                ]);
            }

            $errorMessage = data_get($errorPayload ?? [], 'error.message')
                ?? data_get($errorPayload ?? [], 'error')
                ?? 'The AI service returned an unexpected error.';

            // If the primary model is overloaded, try a lighter fallback model once
            $isOverloaded = $response->status() === 503
                && Str::contains(Str::lower($errorMessage), 'overloaded');

            if ($isOverloaded && $model !== 'gemini-1.5-flash') {
                $fallbackModel = 'gemini-1.5-flash';

                try {
                    $fallbackResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])
                        ->timeout(30)
                        ->post("https://generativelanguage.googleapis.com/v1beta/models/{$fallbackModel}:generateContent?key={$apiKey}", [
                            'systemInstruction' => [
                                'role' => 'user',
                                'parts' => [
                                    ['text' => $systemPrompt],
                                ],
                            ],
                            'contents' => $contents,
                            'generationConfig' => [
                                'temperature' => 0.2,
                                'topP' => 0.8,
                                'topK' => 40,
                                'maxOutputTokens' => 1024,
                            ],
                        ]);

                    \Log::info('Gemini fallback API Response', [
                        'status' => $fallbackResponse->status(),
                        'body' => $fallbackResponse->body(),
                    ]);

                    if (! $fallbackResponse->failed()) {
                        $data = $fallbackResponse->json();
                        $parts = data_get($data, 'candidates.0.content.parts', []);
                        $reply = collect($parts)
                            ->pluck('text')
                            ->filter()
                            ->implode("\n\n");

                        if ($reply) {
                            return response()->json([
                                'reply' => trim($reply),
                                'model' => $fallbackModel,
                            ], Response::HTTP_OK);
                        }
                    }
                } catch (\Throwable $fallbackException) {
                    \Log::error('Gemini fallback API Error', [
                        'message' => $fallbackException->getMessage(),
                        'code' => $fallbackException->getCode(),
                    ]);
                }
            }

            return response()->json([
                'reply' => $errorMessage,
            ], $response->status());
        }

        $data = $response->json();

        $parts = data_get($data, 'candidates.0.content.parts', []);
        $reply = collect($parts)
            ->pluck('text')
            ->filter()
            ->implode("\n\n");

        if (! $reply) {
            return response()->json([
                'reply' => 'I had trouble generating a helpful response. Could you rephrase your question?',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'reply' => trim($reply),
        ]);
    }
}
