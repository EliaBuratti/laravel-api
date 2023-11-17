<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::orderByDesc('id')->paginate(15);
        return view('admin.technology.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technology.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request, Technology $technology)
    {
        $data = $request->validated();
        $data['slug'] = $technology->createSlug($data['name']);
        //dd($data);
        Technology::create($data);
        return to_route('admin.technology.index')->with('message', 'Created sucessfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technology.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technology.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $data = $request->validated();
        $data['slug'] = $technology->createSlug($data['name']);
        //dd($data);
        $technology->update($data);
        return to_route('admin.technology.index')->with('message', 'Technology updated sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->project()->detach(); //scollego dalla tabella pivot

        $technology->delete(); //ora rimuovo il campo dalla tabella technologies

        return to_route('admin.technology.index')->with('message', 'Delete sucessfully');
    }
}
