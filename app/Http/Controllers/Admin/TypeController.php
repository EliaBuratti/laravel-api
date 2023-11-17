<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderByDesc('id')->paginate(15);
        return view('admin.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request, Type $type)
    {
        $validated = $request->validated();
        $data = $request->all();

        $data['slug'] = $type->createSlug($request->name);

        //dd($data);
        $new_type = Type::create($data);
        return to_route('admin.type.index')->with('message', 'Created sucessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $data = $request->validated();
        $data['slug'] = $type->createSlug($request->name);

        //dd($data);
        $type->update($data);
        return to_route('admin.type.index')->with('message', 'Type updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $projects = Project::all()->where('type_id', '=', $type->id)->all(); //ottengo tutti i progetti con questo id del type

        //ciclo i risultati settando su null il campo type_id e faccio l'update
        foreach ($projects as $project) {
            $project->type_id = null;
            $project->update();
        }

        //dd($type);
        $type->delete();
        return to_route('admin.type.index')->with('message', 'Delete sucessfully');
    }
}
