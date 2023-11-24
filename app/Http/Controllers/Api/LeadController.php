<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadEmail;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class LeadController extends Controller
{
    public function store(Request $request) {

        $val_data = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'object' => 'required|max:100',
            'email' => 'required|email',
            'message' => 'required',
        ]);


        if($val_data->fails()) {
            return response()->json([
                'errors' => $val_data->errors(),
                'success' => false,
            ]);
        } 

        $new_lead = Lead::create($request->all());

    
        Mail::to('info@boolean.com')->send(new NewLeadEmail($new_lead));
    
            return response()->json([
                'response' => 'Thank you, for contact me!',
                'success' => true,
            ]);



        
    }
}
