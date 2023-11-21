<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index() {
        return response()->json([
            'response' => Technology::all(),
            'status' => true,
        ]);
    }

    public function show($slug) {
        
        $technology = Technology::with('projects')->where('slug', $slug)->orderByDesc('id')->paginate(6);
        //dd($technology);
        if($technology) {
            return response()->json([
                'response' => $technology,
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
