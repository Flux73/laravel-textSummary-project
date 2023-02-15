<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;

class TextController extends Controller
{
    public function index() 
    {
        // Auth::user()->texts;
        return view('index', ['result' => '']); 
    }

    public function summarizeText(Request $request) 
    {
        // $request->validate([
        //     'inputed_text' => ['required', 'max:1000', 'min:50'],
        // ]);

        $prompt = trim($request->inputed_text);
        $result = OpenAI::completions()->create([
            "model" => "text-davinci-003",
            "prompt" => $prompt . "\n\nTl;dr",
            "temperature" => 0.7,
            "max_tokens" => 250,
            "top_p" => 1.0,
            "frequency_penalty" => 0.0,
            "presence_penalty" => 1, 
        ]);

        $summarized_text = preg_replace('/[:-]/', '', $result['choices'][0]['text'], 1);
        if (Auth::user()) {
            Text::create([
                'user_id' => Auth::id(),
                'text' => $prompt,
                'text_summary' => $summarized_text,
            ]);
        }

        return redirect()->route('home', ['result' => $summarized_text, 'original' => $prompt]); 
    }
}
