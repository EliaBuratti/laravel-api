<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MailController extends Controller
{
    public function index()
    {
        //dd(Lead::all());
        $mails = Lead::orderByDesc('id')->paginate(10);
        return view('admin.mail.index', compact('mails'));
    }

    public function assistantResponse(Request $request) 
    {
        var_dump(env('KEY_OPENAI'));
        //dd($request);
        $provaRequeest = 'ciao, ti contatto perchè ho visto i tuoi progetti, volevo dirti che sono moto belli e vorei proporti una collaborazione, cosa ne pensi?';
        $provaResponse = 'Grazie per i complimenti! Sono aperto alle collaborazioni. Mi piacerebbe saperne di più sui dettagli del progetto che hai in mente.';

        return response($provaRequeest);
        dd('sono oltre');
        
        $message = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('KEY_OPENAI'),
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Voglio che ti comporti come se fossi un assistente virtuale che mi aiuti a genereare delle risposte in base al messaggio che ricevo. Non fare riferimento a te stesso.Ogni risposta ha un massimo di 150 caratteri. Non aggiungere mai altre spiegazioni. Le tue risposte sono solo in formato JSON come questo esempio:\n\n###\n\n{"response":"risposta alla domanda"}',
                ],
                [
                    'role' => 'user',
                    'content' => $provaRequeest ,
                ],
            ],
                'temperature' => 0.7,
                'max_tokens' => 150,
        ]);
        $result = $message->json();
        $response = $result['choices'][0]['message']['content'];
        $responseText = json_decode($response,true)['response'];
        dd($responseText); //restituisce provaresponse sopra

        /* da stampare in pagina alla richiesta */
    }
}
