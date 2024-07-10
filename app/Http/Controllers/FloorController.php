<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Floor";
        $floors = Floor::all();
        return view('pages.floor.index', ['title' => $title, 'floors' => $floors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Floor";
        return view('pages.floor.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'description' => 'required'
        ]);
        Floor::create($data);
        return redirect(route('floor.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Floor $floor)
    {
        $title = "Edit Floor";
        return view('pages.floor.edit', ['title' => $title, 'floor' => $floor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Floor $floor)
    {
        $floor = Floor::findOrFail($floor->id);
        // dd($request->file('image'), $statusRoom);
        $data = $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'description' => 'required'
        ]);
        $floor->update($data);
        return redirect(route('floor.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Floor $floor)
    {
        $floor = Floor::findOrFail($floor->id);
        Floor::destroy($floor->id);
        return redirect(route('floor.index'));
    }
}
