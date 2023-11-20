<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use phpDocumentor\Reflection\Types\Null_;

class ProjectController extends Controller
{
    public function index() {
        return response()->json([
            'response' => Project::with('type', 'technology')->paginate(6),
            'status' => true,
        ]);
    }

    public function show($slug) {
        
        $project = Project::with('type', 'technology')->where('slug', $slug)->first();
        //dd($project);
        if($project) {
            return response()->json([
                'response' => $project,
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
