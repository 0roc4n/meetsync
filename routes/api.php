<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenAI\Client;

Route::post('/translate', function (Request $request) {
    $client = OpenAI::client(env('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'));

    $response = $client->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'system', 
                'content' => 'You are a translator. Translate the following text to English. If the text is already in English, return it unchanged. Keep the translation natural and conversational.'
            ],
            ['role' => 'user', 'content' => $request->text]
        ],
        'temperature' => 0.3
    ]);

    return response()->json([
        'translatedText' => $response->choices[0]->message->content
    ]);
});