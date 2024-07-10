<?php

namespace App\Http\Controllers;

use App\Models\Accupation;
use Illuminate\Http\Request;

class AccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Occupation";
        $occupations = Accupation::all();
        return view('pages.occupation.index', ['title' => $title, 'occupations' => $occupations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Occupation";
        return view('pages.occupation.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        Accupation::create($data);
        return redirect(route('occupation.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Accupation $occupation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accupation $occupation)
    {
        $title = "Edit Occupation";
        return view('pages.occupation.edit', ['title' => $title, 'occupation' => $occupation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accupation $occupation)
    {
        $occupation = Accupation::findOrFail($occupation->id);
        // dd($request->file('image'), $occupation);
        $data = $request->validate([
            'name' => 'required',
        ]);
        $occupation->update($data);
        return redirect(route('occupation.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accupation $occupation)
    {
        $occupation = Accupation::findOrFail($occupation->id);
        Accupation::destroy($occupation->id);
        return redirect(route('occupation.index'));
    }
}
