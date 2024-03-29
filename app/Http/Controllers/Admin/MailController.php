<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ResponseEmail;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Pest\Plugins\Parallel\Handlers\Laravel;

class MailController extends Controller
{
    public function index()
    {
        //dd(Lead::all());
        $mails = Lead::orderByDesc('id')->where('mailType', '=', 'Response')->paginate(10);
        return view('admin.mail.response', compact('mails'));
    }

    public function assistantResponse($mailId) 
    {
        $message = Lead::find($mailId)->message;

        //return response('mailcontroller');
        
        $message = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('KEY_OPENAI'),
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Voglio che ti comporti come se fossi un assistente virtuale che mi aiuti a genereare delle risposte in base al messaggio che ricevo. Non fare riferimento a te stesso.Ogni risposta ha un massimo di 150 caratteri. Non aggiungere mai altre spiegazioni. Le tue risposte sono solo in formato JSON come questo esempio: {"response":"risposta alla domanda"}',
                ],
                [
                    'role' => 'user',
                    'content' => $message ,
                ],
            ],
                'temperature' => 0.7,
                'max_tokens' => 150,
        ]);

        $result = $message->json();
        $response = $result['choices'][0]['message']['content'];
        $responseText = json_decode($response,true)['response'];
        return response($responseText);
    }

    public function store(Request $request) {

        //dd($request);

        $request['mailType'] = 'Response';

        $val_data = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'object' => 'required|max:100',
            'email' => 'required|email',
            'message' => 'required|min:10|max:5000',
        ]);

        if($val_data->fails()) {
            return  back()->withErrors($val_data->errors())->withInput($request->only('name', 'email','object','message'));
        }


        $new_lead = Lead::create($request->all());

    
        Mail::to($request->email)->send(new ResponseEmail($new_lead));
    
            return back()->with('message', 'Mail sent!');
        
    }

    public function destroy($request)
    {

        $mail = Lead::find($request);

        $mail->delete();

        return back()->with('message', 'Delete sucessfully');
    }


}
