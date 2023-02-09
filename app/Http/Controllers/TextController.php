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
        
        // Morocco is a country located in North Africa, known for its rich history and cultural heritage. It has a diverse geography that ranges from the Atlantic and Mediterranean coasts to the rugged Atlas Mountains. Morocco is also famous for its vibrant cities like Marrakesh, Fez, and Casablanca that offer a unique blend of traditional and modern cultures.\nOne of the most iconic landmarks in Morocco is the Hassan II Mosque, located in Casablanca. This stunning mosque is the largest in Morocco and one of the largest in the world, with a capacity of over 25,000 worshipers. It is a marvel of modern architecture, with its towering minaret and intricate details. Visitors to the mosque can take guided tours to learn about its history and religious significance.\nMoroccan cuisine is a blend of Mediterranean, African, and Arabic influences, and is known for its use of spices and herbs. Some popular dishes include tagine, a slow-cooked stew made with meat, vegetables, and spices, and couscous, a staple grain made from semolina that is often served with meat or vegetables. Visitors to Morocco can also enjoy mint tea, a sweet and refreshing drink made with green tea, mint leaves, and sugar that is traditionally served throughout the day.
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
