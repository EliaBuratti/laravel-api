<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index() {
        return response()->json([
            'response' => Type::all(),
            'status' => true,
        ]);
    }

    public function show($slug) {
        
        $type = Type::with('projects')->where('slug', $slug)->orderByDesc('id')->paginate(6);
        //dd($type);
        if($type) {
            return response()->json([
                'response' => $type,
                'status' => true,
            ]);
        }
        else {
            return response()->json([
                'response' => 'Project not found',
                'status' => false,
            ]);
        }
        
    }
}
