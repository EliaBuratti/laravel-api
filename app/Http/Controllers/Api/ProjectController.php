<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;

class ProjectController extends Controller
{
    public function index() {
        return response()->json([
            'response' => Project::with('type', 'technology')->paginate(5),
            ]);
    }
}
