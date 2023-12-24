<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        //dd(Lead::all());
        $mail = Lead::orderByDesc('id')->paginate(10);
        return view('admin.mail.index', compact('mail'));
    }
}
