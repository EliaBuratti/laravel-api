<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        $types = Type::all();
        $total_users = User::all()->count();
        return view('admin.dashboard', compact('projects', 'types', 'total_users'));
    }
}
