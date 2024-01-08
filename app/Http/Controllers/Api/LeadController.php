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

    public function index()
    {
        //dd(Lead::all());
        $mails = Lead::orderByDesc('id')->where('mailType', '=', 'New Lead')->paginate(10);
        return view('admin.mail.leads', compact('mails'));
    }

    public function store(Request $request) {

        //dd($request);
        $request['mailType'] = 'New Lead';
        
        $val_data = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'object' => 'required|max:100',
            'email' => 'required|email',
            'message' => 'required|min:10|max:5000',
        ]);


        if($val_data->fails()) {
            return response()->json([
                'errors' => $val_data->errors(),
                'success' => false,
            ]);
        } 


        $new_lead = Lead::create($request->all());

    
        Mail::to('elia.buratti.dev@gmail.com')->send(new NewLeadEmail($new_lead));
    
            return response()->json([
                'response' => 'Thank you, for contact me!',
                'success' => true,
            ]);
        
    }

    public function destroy(Lead $lead)
    {

        dd($lead);

        $lead->delete();

        return to_route('admin.project.index')->with('message', 'Delete sucessfully');
    }
}
