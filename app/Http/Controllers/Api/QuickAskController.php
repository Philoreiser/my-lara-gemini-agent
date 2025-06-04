<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gemini;
use Gemini\Data\Content;
use Gemini\Enums\Role;

class QuickAskController extends Controller
{

    public function __invoke(Request $request)
    {
        # Reference: https://github.com/google-gemini-php/client
        $myApiKey = env('MY_GEMINI_API_KEY');
        $client = Gemini::client($myApiKey);

        $prompt = $request->input('prompt');
        $result = $client->generativeModel(model: 'gemini-2.0-flash')->generateContent($prompt);

        $message = $result->text();

        return json_encode([
            'prompt' => $prompt,
            // 'MyGeminiApiKey' => env('MY_GEMINI_API_KEY'),
            'message' => $message,
        ], true);
    }

    public function chat()
    {
        $myApiKey = env('MY_GEMINI_API_KEY');
        $client = Gemini::client($myApiKey);

        $chat = $client
            ->generativeModel(model: 'gemini-2.0-flash')
            ->startChat(history: [
                Content::parse(part: 'Explain RESTful API in short words'),
                Content::parse(
                    part: "A RESTful API is a way for two computer systems to communicate over the internet using standard HTTP methods (like GET, POST, PUT, DELETE) to access and manipulate resources. Think of it as a waiter taking your orders (requests) and bringing you back what you asked for (data) from the kitchen (server).  It's simple, scalable, and widely used.\n", 
                    role: Role::MODEL
                )
            ]);

        $response = $chat->sendMessage('Please translate your answer to Chinese');
        echo $response->text(); 

        $response = $chat->sendMessage('Please translate your answer to Traditional Chinese');
        echo $response->text(); 
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
